<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->with('category');

        if ($request->filled('q')) {
            $keyword = trim($request->get('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%');
                if (is_numeric($keyword)) {
                    $q->orWhere('id', (int) $keyword);
                }
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        $news = $query->orderByDesc('id')->paginate(10)->appends($request->all());
        $categories = Category::where('type', 'news')->orderBy('name')->get();

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'news')->orderBy('name')->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable'],
        ]);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/news');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $thumbPath = 'uploads/news/' . $name;
        }

        $rawSlug = $validated['slug'] ?? $validated['title'];
        $slug = $this->makeUniqueSlug($rawSlug);

        News::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'] ?? null,
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbPath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Đã tạo tin tức.');
    }

    public function edit(News $news)
    {
        $categories = Category::where('type', 'news')->orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable'],
        ]);

        $thumbPath = $news->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbPath && File::exists(public_path($thumbPath))) {
                File::delete(public_path($thumbPath));
            }
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/news');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $thumbPath = 'uploads/news/' . $name;
        }

        $rawSlug = $validated['slug'] ?? $validated['title'];
        $slug = $this->makeUniqueSlug($rawSlug, $news->id);

        $news->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'] ?? null,
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbPath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Đã cập nhật tin tức.');
    }

    public function destroy(News $news)
    {
        if ($news->thumbnail && File::exists(public_path($news->thumbnail))) {
            File::delete(public_path($news->thumbnail));
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Đã xóa tin tức.');
    }

    private function makeUniqueSlug(string $raw, ?int $ignoreId = null): string
    {
        $base = Str::slug($raw);
        if ($base === '') {
            $base = 'news';
        }

        $slug = $base;
        $i = 1;
        while (
            News::where('slug', $slug)
                ->when($ignoreId, function ($q) use ($ignoreId) {
                    $q->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
