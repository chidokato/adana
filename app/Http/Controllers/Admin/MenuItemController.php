<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Menu $menu)
    {
        $items = MenuItem::where('menu_id', $menu->id)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('position')
            ->get();
        return view('admin.menu_item.index', compact('menu', 'items'));
    }

    public function create(Menu $menu)
    {
        $parents = MenuItem::where('menu_id', $menu->id)->orderBy('position')->get();
        return view('admin.menu_item.create', compact('menu', 'parents'));
    }

    public function store(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'label' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'integer'],
            'status' => ['nullable'],
        ]);

        MenuItem::create([
            'menu_id' => $menu->id,
            'parent_id' => $data['parent_id'] ?? null,
            'label' => $data['label'],
            'url' => $data['url'] ?? null,
            'target' => $data['target'] ?? '_self',
            'position' => $data['position'] ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.menus.items.index', $menu)->with('success', 'Đã thêm menu item.');
    }

    public function edit(Menu $menu, MenuItem $item)
    {
        $parents = MenuItem::where('menu_id', $menu->id)
            ->where('id', '!=', $item->id)
            ->orderBy('position')
            ->get();
        return view('admin.menu_item.edit', compact('menu', 'item', 'parents'));
    }

    public function update(Request $request, Menu $menu, MenuItem $item)
    {
        $data = $request->validate([
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'label' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'target' => ['nullable', 'string', 'max:20'],
            'position' => ['nullable', 'integer'],
            'status' => ['nullable'],
        ]);

        $item->update([
            'parent_id' => $data['parent_id'] ?? null,
            'label' => $data['label'],
            'url' => $data['url'] ?? null,
            'target' => $data['target'] ?? '_self',
            'position' => $data['position'] ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.menus.items.index', $menu)->with('success', 'Đã cập nhật menu item.');
    }

    public function destroy(Menu $menu, MenuItem $item)
    {
        $item->delete();
        return redirect()->route('admin.menus.items.index', $menu)->with('success', 'Đã xóa menu item.');
    }
}
