<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::guard('admin')->user();

        if (!$user || !in_array($user->role, $roles, true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Bạn không có quyền truy cập chức năng này.',
                    'redirect' => route('admin.dashboard'),
                ], 403);
            }

            return redirect()->route('admin.dashboard')->with('center_warning', 'Bạn không có quyền truy cập chức năng này.');
        }

        return $next($request);
    }
}
