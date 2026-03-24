<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $isFiltered = false;
        $type = $request->get('type');

        if ($request->filled('q')) {
            $isFiltered = true;
            $keyword = trim($request->get('q'));
            $query = Category::query()->orderByDesc('id');
            $query->where('name', 'like', '%' . $keyword . '%');
            if (is_numeric($keyword)) {
                $query->orWhere('id', (int) $keyword);
            }
            if ($type) {
                $query->where('type', $type);
            }
            $categories = $query->paginate(10)->appends($request->all());
        } else {
            $rootQuery = Category::with('children')->whereNull('parent_id')->orderBy('name');
            if ($type) {
                $rootQuery->where('type', $type);
            }
            $categories = $rootQuery->get();
        }

        return view('admin.category.index', compact('categories', 'isFiltered', 'type'));
    }

    public function create()
    {
        $parents = Category::orderBy('name')->get();
        return view('admin.category.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'type' => ['required', 'in:product,news'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['nullable'],
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Category::find($validated['parent_id']);
            if ($parent && $parent->type !== $validated['type']) {
                return back()->withInput()->withErrors(['parent_id' => 'Danh mục cha phải cùng loại.']);
            }
        }

        $slug = Str::slug($validated['name']);
        if (Category::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        Category::create([
            'parent_id' => $validated['parent_id'] ?? null,
            'type' => $validated['type'],
            'name' => $validated['name'],
            'slug' => $slug,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Đã tạo danh mục.');
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '!=', $category->id)->orderBy('name')->get();
        return view('admin.category.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'type' => ['required', 'in:product,news'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['nullable'],
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Category::find($validated['parent_id']);
            if ($parent && $parent->type !== $validated['type']) {
                return back()->withInput()->withErrors(['parent_id' => 'Danh mục cha phải cùng loại.']);
            }
        }

        $slug = Str::slug($validated['name']);
        if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug .= '-' . time();
        }

        $category->update([
            'parent_id' => $validated['parent_id'] ?? null,
            'type' => $validated['type'],
            'name' => $validated['name'],
            'slug' => $slug,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Đã xóa danh mục.');
    }

    public function toggleStatus(Category $category)
    {
        $category->update([
            'status' => $category->status ? 0 : 1,
        ]);

        return back()->with('success', 'Đã cập nhật trạng thái.');
    }
}
