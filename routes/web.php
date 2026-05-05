<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MediaBannerController;
use App\Http\Controllers\Admin\HomeConfigController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/gioi-thieu', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/lien-he', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/san-pham', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/danh-muc-san-pham/{slug}', [FrontendController::class, 'productCategory'])->name('frontend.products.category');
Route::get('/san-pham/{slug}', [FrontendController::class, 'productDetail'])->name('frontend.products.show');
Route::get('/tin-tuc', [FrontendController::class, 'news'])->name('frontend.news');
Route::get('/danh-muc-tin-tuc/{slug}', [FrontendController::class, 'newsCategory'])->name('frontend.news.category');
Route::get('/tin-tuc/{slug}', [FrontendController::class, 'newsDetail'])->name('frontend.news.show');

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth
    Route::get('/', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::get('/auth/google', [AdminAuthController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [AdminAuthController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth:admin');

    // Protected Admin
    Route::middleware(['auth:admin', 'admin.active'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        // Categories
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
            Route::post('/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('toggleStatus');
        });

        // Admin Users
        Route::prefix('users')->name('users.')->middleware('admin.role:admin')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('toggleStatus');
        });

        // News
        Route::prefix('news')->name('news.')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/create', [NewsController::class, 'create'])->name('create');
            Route::post('/', [NewsController::class, 'store'])->name('store');
            Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');
            Route::put('/{news}', [NewsController::class, 'update'])->name('update');
            Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
        });

        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });

        // SEO Settings
        Route::prefix('seo')->name('seo.')->middleware('admin.role:admin')->group(function () {
            Route::get('/', [SeoSettingController::class, 'index'])->name('index');
            Route::get('/create', [SeoSettingController::class, 'create'])->name('create');
            Route::post('/', [SeoSettingController::class, 'store'])->name('store');
            Route::get('/{seo}/edit', [SeoSettingController::class, 'edit'])->name('edit');
            Route::put('/{seo}', [SeoSettingController::class, 'update'])->name('update');
            Route::delete('/{seo}', [SeoSettingController::class, 'destroy'])->name('destroy');
        });

        // Settings
        Route::middleware('admin.role:admin')->group(function () {
            Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
            Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        });

        // Menus
        Route::prefix('menus')->name('menus.')->middleware('admin.role:admin')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('index');
            Route::get('/create', [MenuController::class, 'create'])->name('create');
            Route::post('/', [MenuController::class, 'store'])->name('store');
            Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
            Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
            Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');

            Route::get('/{menu}/items', [MenuItemController::class, 'index'])->name('items.index');
            Route::get('/{menu}/items/create', [MenuItemController::class, 'create'])->name('items.create');
            Route::post('/{menu}/items', [MenuItemController::class, 'store'])->name('items.store');
            Route::get('/{menu}/items/{item}/edit', [MenuItemController::class, 'edit'])->name('items.edit');
            Route::put('/{menu}/items/{item}', [MenuItemController::class, 'update'])->name('items.update');
            Route::delete('/{menu}/items/{item}', [MenuItemController::class, 'destroy'])->name('items.destroy');
        });

        // Slider & Banner
        Route::prefix('media-banners')->name('media-banners.')->middleware('admin.role:admin')->group(function () {
            Route::get('/', [MediaBannerController::class, 'index'])->name('index');
            Route::get('/create', [MediaBannerController::class, 'create'])->name('create');
            Route::post('/', [MediaBannerController::class, 'store'])->name('store');
            Route::get('/{media_banner}/edit', [MediaBannerController::class, 'edit'])->name('edit');
            Route::put('/{media_banner}', [MediaBannerController::class, 'update'])->name('update');
            Route::delete('/{media_banner}', [MediaBannerController::class, 'destroy'])->name('destroy');
        });

        // Home Configs
        Route::prefix('home-configs')->name('home-configs.')->middleware('admin.role:admin')->group(function () {
            Route::get('/', [HomeConfigController::class, 'index'])->name('index');
            Route::get('/create', [HomeConfigController::class, 'create'])->name('create');
            Route::post('/', [HomeConfigController::class, 'store'])->name('store');
            Route::get('/{home_config}/edit', [HomeConfigController::class, 'edit'])->name('edit');
            Route::put('/{home_config}', [HomeConfigController::class, 'update'])->name('update');
            Route::delete('/{home_config}', [HomeConfigController::class, 'destroy'])->name('destroy');
        });

        // Upload (CKEditor)
        Route::post('upload', [UploadController::class, 'store'])->name('upload');
    });
});

Route::get('/{slug}', [FrontendController::class, 'page'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('frontend.page');
