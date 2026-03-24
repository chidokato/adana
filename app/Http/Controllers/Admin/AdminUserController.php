<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $users = $query->paginate(10)->appends($request->all());
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admin_users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'status' => ['nullable'],
        ]);

        AdminUser::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Đã tạo người dùng.');
    }

    public function edit(AdminUser $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, AdminUser $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admin_users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'status' => ['nullable'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $request->has('status') ? 1 : 0,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật người dùng.');
    }

    public function destroy(AdminUser $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng.');
    }

    public function toggleStatus(AdminUser $user)
    {
        $user->update([
            'status' => $user->status ? 0 : 1,
        ]);

        return back()->with('success', 'Đã cập nhật trạng thái.');
    }
}
