<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureActiveAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            if ((int) $admin->status !== 1) {
                Auth::guard('admin')->logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Tài khoản của bạn không còn quyền truy cập admin.',
                        'redirect' => route('admin.login'),
                    ], 403);
                }

                return redirect()->route('admin.login')->with('center_warning', 'Tài khoản của bạn không còn quyền truy cập admin.');
            }
        }

        return $next($request);
    }
}
