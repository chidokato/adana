<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query()->orderByDesc('id');

        if ($request->filled('q')) {
            $keyword = trim($request->get('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
                if (is_numeric($keyword)) {
                    $q->orWhere('id', (int) $keyword);
                }
            });
        }

        $menus = $query->paginate(10)->appends($request->all());
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        Menu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Đã tạo menu.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Đã cập nhật menu.');
    }

    public function destroy(Menu $menu)
    {
        $menu->items()->delete();
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Đã xóa menu.');
    }
}

