<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Category;
use App\Models\HomeConfig;
use App\Models\MediaBanner;
use App\Models\Menu;
use App\Models\News;
use App\Models\Product;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login.index');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt(array_merge($validated, ['status' => 1]), $remember)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'Email, mật khẩu hoặc trạng thái tài khoản không hợp lệ.'])
            ->withInput();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('admin.login')->with('error', 'Không thể đăng nhập bằng Google.');
        }

        $adminUser = AdminUser::where('google_id', $googleUser->getId())->first();

        if (!$adminUser) {
            $adminUser = AdminUser::where('email', $googleUser->getEmail())->first();

            if (!$adminUser) {
                $adminUser = AdminUser::create([
                    'name' => $googleUser->getName() ?: 'Google User',
                    'email' => $googleUser->getEmail(),
                    'role' => AdminUser::ROLE_EDITOR,
                    'password' => bcrypt(Str::random(32)),
                    'status' => 0,
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'google_token' => isset($googleUser->token) ? encrypt($googleUser->token) : null,
                    'google_refresh_token' => isset($googleUser->refreshToken) ? encrypt($googleUser->refreshToken) : null,
                    'google_token_expires_at' => isset($googleUser->expiresIn) ? now()->addSeconds($googleUser->expiresIn) : null,
                ]);

                return redirect()->route('admin.login')->with('center_warning', 'Tài khoản của bạn đã được ghi nhận. Vui lòng đợi admin duyệt quyền truy cập.');
            }
        }

        if ((int) $adminUser->status !== 1) {
            $adminUser->forceFill([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'google_token' => isset($googleUser->token) ? encrypt($googleUser->token) : $adminUser->google_token,
                'google_refresh_token' => isset($googleUser->refreshToken) ? encrypt($googleUser->refreshToken) : $adminUser->google_refresh_token,
                'google_token_expires_at' => isset($googleUser->expiresIn) ? now()->addSeconds($googleUser->expiresIn) : $adminUser->google_token_expires_at,
            ])->save();

            return redirect()->route('admin.login')->with('center_warning', 'Tài khoản của bạn đang chờ admin duyệt quyền truy cập.');
        }

        $adminUser->forceFill([
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'google_token' => isset($googleUser->token) ? encrypt($googleUser->token) : $adminUser->google_token,
            'google_refresh_token' => isset($googleUser->refreshToken) ? encrypt($googleUser->refreshToken) : $adminUser->google_refresh_token,
            'google_token_expires_at' => isset($googleUser->expiresIn) ? now()->addSeconds($googleUser->expiresIn) : $adminUser->google_token_expires_at,
        ])->save();

        Auth::guard('admin')->login($adminUser, true);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            [
                'label' => 'Danh mục',
                'count' => Category::count(),
                'icon' => 'ri-list-check-2',
                'color' => 'success',
                'route' => route('admin.categories.index'),
            ],
            [
                'label' => 'Sản phẩm',
                'count' => Product::count(),
                'icon' => 'ri-shopping-bag-3-line',
                'color' => 'primary',
                'route' => route('admin.products.index'),
            ],
            [
                'label' => 'Tin tức',
                'count' => News::count(),
                'icon' => 'ri-newspaper-line',
                'color' => 'warning',
                'route' => route('admin.news.index'),
            ],
            [
                'label' => 'Người dùng admin',
                'count' => AdminUser::count(),
                'icon' => 'ri-user-settings-line',
                'color' => 'info',
                'route' => route('admin.users.index'),
            ],
        ];

        $quickLinks = [
            ['label' => 'Quản lý menu', 'icon' => 'ri-menu-line', 'route' => route('admin.menus.index')],
            ['label' => 'Cấu hình website', 'icon' => 'ri-settings-3-line', 'route' => route('admin.settings.edit')],
            ['label' => 'Cấu hình trang chủ', 'icon' => 'ri-layout-grid-line', 'route' => route('admin.home-configs.index')],
            ['label' => 'SEO', 'icon' => 'ri-line-chart-line', 'route' => route('admin.seo.index')],
            ['label' => 'Slider & banner', 'icon' => 'ri-image-2-line', 'route' => route('admin.media-banners.index')],
        ];

        $contentSummary = [
            ['label' => 'Menu', 'count' => Menu::count()],
            ['label' => 'SEO pages', 'count' => SeoSetting::count()],
            ['label' => 'Slider/Banner', 'count' => MediaBanner::count()],
            ['label' => 'Khối trang chủ', 'count' => HomeConfig::count()],
        ];

        return view('admin.dashboard', compact('stats', 'quickLinks', 'contentSummary'));
    }
}
