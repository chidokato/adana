<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('q')) {
            $keyword = trim($request->get('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('product_code', 'like', '%' . $keyword . '%');
                if (is_numeric($keyword)) {
                    $q->orWhere('id', (int) $keyword);
                }
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        $products = $query->orderByDesc('id')->paginate(10)->appends($request->all());
        $categories = Category::where('type', 'product')->orderBy('name')->get();

        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'product')->orderBy('name')->get();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'product_code' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:4096'],
            'status' => ['nullable'],
        ]);

        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/products');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $thumbPath = 'uploads/products/' . $name;
        }

        $rawSlug = $validated['slug'] ?? $validated['title'];
        $slug = $this->makeUniqueSlug($rawSlug);

        $product = Product::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'product_code' => $validated['product_code'] ?? null,
            'price' => $validated['price'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbPath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        $this->storeImages($request, $product->id);

        return redirect()->route('admin.products.index')->with('success', 'Đã tạo sản phẩm.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('type', 'product')->orderBy('name')->get();
        $product->load('images');
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'product_code' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:4096'],
            'remove_images' => ['nullable', 'array'],
            'remove_images.*' => ['integer'],
            'status' => ['nullable'],
        ]);

        $thumbPath = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbPath && File::exists(public_path($thumbPath))) {
                File::delete(public_path($thumbPath));
            }
            $file = $request->file('thumbnail');
            $name = time() . '_' . $file->getClientOriginalName();
            $dest = public_path('uploads/products');
            if (!File::exists($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $file->move($dest, $name);
            $thumbPath = 'uploads/products/' . $name;
        }

        $rawSlug = $validated['slug'] ?? $validated['title'];
        $slug = $this->makeUniqueSlug($rawSlug, $product->id);

        $product->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'product_code' => $validated['product_code'] ?? null,
            'price' => $validated['price'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'content' => $validated['content'] ?? null,
            'thumbnail' => $thumbPath,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        if (!empty($validated['remove_images'])) {
            $images = ProductImage::where('product_id', $product->id)
                ->whereIn('id', $validated['remove_images'])
                ->get();
            foreach ($images as $image) {
                if ($image->path && File::exists(public_path($image->path))) {
                    File::delete(public_path($image->path));
                }
                $image->delete();
            }
        }

        $this->storeImages($request, $product->id);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm.');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail && File::exists(public_path($product->thumbnail))) {
            File::delete(public_path($product->thumbnail));
        }

        $images = $product->images()->get();
        foreach ($images as $image) {
            if ($image->path && File::exists(public_path($image->path))) {
                File::delete(public_path($image->path));
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm.');
    }

    private function storeImages(Request $request, int $productId): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $dest = public_path('uploads/products/gallery');
        if (!File::exists($dest)) {
            File::makeDirectory($dest, 0755, true);
        }

        foreach ($request->file('images') as $file) {
            if (!$file) {
                continue;
            }
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move($dest, $name);
            ProductImage::create([
                'product_id' => $productId,
                'path' => 'uploads/products/gallery/' . $name,
            ]);
        }
    }

    private function makeUniqueSlug(string $raw, ?int $ignoreId = null): string
    {
        $base = Str::slug($raw);
        if ($base === '') {
            $base = 'product';
        }

        $slug = $base;
        $i = 1;
        while (
            Product::where('slug', $slug)
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
