<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function about()
    {
        return view('frontend.about', [
            'pageTitle' => 'Giới thiệu',
        ]);
    }

    public function contact()
    {
        return view('frontend.contact', [
            'pageTitle' => 'Liên hệ',
        ]);
    }

    public function products(Request $request)
    {
        $categories = Category::where('type', 'product')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        $latestProducts = Product::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();
        $latestNews = News::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();

        $query = Product::with('category')
            ->where('status', 1)
            ->latest('id');

        if ($request->filled('q')) {
            $keyword = trim((string) $request->q);
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('product_code', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();

        return view('frontend.products.index', [
            'pageTitle' => 'Sản phẩm',
            'products' => $products,
            'filterCategories' => $categories,
            'latestProducts' => $latestProducts,
            'latestNews' => $latestNews,
        ]);
    }

    public function productDetail($categorySlug, $slug)
    {
        $product = Product::with('category', 'images')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug)
                    ->where('type', 'product');
            })
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        $latestProducts = Product::with('category')
            ->where('status', 1)
            ->where('id', '!=', $product->id)
            ->latest('id')
            ->take(4)
            ->get();
        $latestNews = News::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();

        return view('frontend.products.show', [
            'pageTitle' => $product->seo_title ?: $product->title,
            'pageDescription' => $product->seo_description ?: $product->description,
            'product' => $product,
            'latestProducts' => $latestProducts,
            'latestNews' => $latestNews,
        ]);
    }

    public function news(Request $request)
    {
        $categories = Category::where('type', 'news')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        $newsCategoryCounts = News::where('status', 1)
            ->selectRaw('category_id, COUNT(*) as total')
            ->whereNotNull('category_id')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');
        $totalNewsCount = News::where('status', 1)->count();

        $query = News::with('category')
            ->where('status', 1)
            ->latest('id');

        if ($request->filled('q')) {
            $keyword = trim((string) $request->q);
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        $newsList = $query->paginate(10)->withQueryString();

        return view('frontend.news.index', [
            'pageTitle' => 'Tin tức',
            'newsList' => $newsList,
            'newsCategories' => $categories,
            'newsCategoryCounts' => $newsCategoryCounts,
            'totalNewsCount' => $totalNewsCount,
        ]);
    }

    public function newsDetail($slug)
    {
        $news = News::with('category')
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        $latestProducts = Product::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();
        $latestNews = News::with('category')
            ->where('status', 1)
            ->where('id', '!=', $news->id)
            ->latest('id')
            ->take(4)
            ->get();

        return view('frontend.news.show', [
            'pageTitle' => $news->seo_title ?: $news->title,
            'pageDescription' => $news->seo_description ?: $news->description,
            'news' => $news,
            'latestProducts' => $latestProducts,
            'latestNews' => $latestNews,
        ]);
    }

    public function newsCategory(Request $request, $slug)
    {
        $category = Category::where('type', 'news')
            ->where('slug', $slug)
            ->firstOrFail();

        $categories = Category::where('type', 'news')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        $newsCategoryCounts = News::where('status', 1)
            ->selectRaw('category_id, COUNT(*) as total')
            ->whereNotNull('category_id')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');
        $totalNewsCount = News::where('status', 1)->count();

        $query = News::with('category')
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest('id');

        if ($request->filled('q')) {
            $keyword = trim((string) $request->q);
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        $newsList = $query->paginate(10)->withQueryString();

        return view('frontend.news.index', [
            'pageTitle' => $category->name,
            'newsList' => $newsList,
            'newsCategories' => $categories,
            'currentNewsCategory' => $category,
            'newsCategoryCounts' => $newsCategoryCounts,
            'totalNewsCount' => $totalNewsCount,
        ]);
    }

    public function productCategory(Request $request, $slug)
    {
        $category = Category::where('type', 'product')
            ->where('slug', $slug)
            ->with('children')
            ->firstOrFail();

        $categoryIds = array_merge([$category->id], $category->descendantIds());

        $categories = Category::where('type', 'product')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        $latestProducts = Product::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();
        $latestNews = News::with('category')
            ->where('status', 1)
            ->latest('id')
            ->take(4)
            ->get();

        $query = Product::with('category')
            ->where('status', 1)
            ->whereIn('category_id', $categoryIds)
            ->latest('id');

        if ($request->filled('q')) {
            $keyword = trim((string) $request->q);
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('product_code', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $products = $query->paginate(12)->withQueryString();

        return view('frontend.products.index', [
            'pageTitle' => $category->name,
            'products' => $products,
            'currentCategory' => $category,
            'filterCategories' => $categories,
            'latestProducts' => $latestProducts,
            'latestNews' => $latestNews,
        ]);
    }

    public function page(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->first();

        if ($category) {
            if ($category->type === 'product') {
                return $this->productCategory($request, $slug);
            }

            if ($category->type === 'news') {
                return $this->newsCategory($request, $slug);
            }
        }

        $menuItem = MenuItem::where('url', $slug)
            ->where('status', 1)
            ->orderBy('id')
            ->firstOrFail();

        return view('frontend.page', [
            'pageTitle' => $menuItem->label,
            'pageLabel' => $menuItem->label,
            'pageSlug' => $slug,
            'menuItem' => $menuItem,
        ]);
    }
}
