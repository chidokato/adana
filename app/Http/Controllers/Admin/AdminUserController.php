<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = AdminUser::query()->orderByDesc('id');

        if ($request->filled('q')) {
            $keyword = trim($request->get('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
                if (is_numeric($keyword)) {
                    $q->orWhere('id', (int) $keyword);
                }
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->get('role'));
        }

        $users = $query->paginate(10)->appends($request->all());
        $roles = AdminUser::roleOptions();

        return view('admin.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = AdminUser::roleOptions();

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admin_users,email'],
            'role' => ['required', Rule::in(array_keys(AdminUser::roleOptions()))],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'status' => ['nullable'],
        ]);

        AdminUser::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Da tao nguoi dung.');
    }

    public function edit(AdminUser $user)
    {
        $roles = AdminUser::roleOptions();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, AdminUser $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admin_users,email,' . $user->id],
            'role' => ['required', Rule::in(array_keys(AdminUser::roleOptions()))],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'status' => ['nullable'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $request->has('status') ? 1 : 0,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Da cap nhat nguoi dung.');
    }

    public function destroy(AdminUser $user)
    {
        if (Auth::guard('admin')->id() === $user->id) {
            return back()->with('error', 'Khong the tu xoa tai khoan dang dang nhap.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Da xoa nguoi dung.');
    }

    public function toggleStatus(Request $request, AdminUser $user)
    {
        $newStatus = $user->status ? 0 : 1;

        $user->update([
            'status' => $newStatus,
        ]);

        if ((int) $newStatus !== 1 && Auth::guard('admin')->id() === $user->id) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Tai khoan cua ban da bi tat va da duoc dang xuat.',
                    'redirect' => route('admin.login'),
                ]);
            }

            return redirect()->route('admin.login')->with('center_warning', 'Tai khoan cua ban da bi tat va da duoc dang xuat.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Da cap nhat trang thai.',
            ]);
        }

        return back()->with('success', 'Da cap nhat trang thai.');
    }
}
