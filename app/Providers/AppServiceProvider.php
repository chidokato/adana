<?php

namespace App\Providers;

use App\Models\SeoSetting;
use App\Models\Category;
use App\Models\HomeConfig;
use App\Models\Menu;
use App\Models\News;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (request()->is('admin*')) {
                return;
            }

            $path = request()->path();
            $urlPath = $path === '' || $path === '/' ? '/' : '/' . ltrim($path, '/');

            $seo = SeoSetting::where('url', $urlPath)->first();
            if ($seo) {
                $view->with('seoTitle', $seo->title);
                $view->with('seoDescription', $seo->description);
            }

            $productCategories = Category::where('type', 'product')
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('name')
                ->get();
            $newsCategories = Category::where('type', 'news')
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('name')
                ->get();

            $view->with('menuProductCategories', $productCategories);
            $view->with('menuNewsCategories', $newsCategories);

            $headerMenu = Menu::where('location', 'header')->first();
            if ($headerMenu) {
                $headerItems = $headerMenu->items()
                    ->whereNull('parent_id')
                    ->where('status', 1)
                    ->orderBy('position')
                    ->get();
                $view->with('headerMenuItems', $headerItems);
            }

            $footerMenu = Menu::where('location', 'footer')->first();
            if ($footerMenu) {
                $footerItems = $footerMenu->items()
                    ->whereNull('parent_id')
                    ->where('status', 1)
                    ->with(['children' => function ($query) {
                        $query->where('status', 1)->orderBy('position');
                    }])
                    ->orderBy('position')
                    ->get();
                $view->with('footerMenuItems', $footerItems);
            }

            $siteSetting = Setting::first();
            if ($siteSetting) {
                $view->with('siteSetting', $siteSetting);
            }

            $sliders = \App\Models\MediaBanner::where('type', 'slider')
                ->where('status', 1)
                ->orderBy('position')
                ->orderByDesc('id')
                ->get();
            $view->with('siteSliders', $sliders);

            $homeConfigs = HomeConfig::all()->keyBy('section_key');
            $view->with('homeConfigs', $homeConfigs);

            $homeProducts = Product::with('category')
                ->where('status', 1)
                ->latest('id')
                ->take(8)
                ->get();
            $view->with('homeProducts', $homeProducts);

            $homeNews = News::with('category')
                ->where('status', 1)
                ->latest('id')
                ->take(8)
                ->get();
            $view->with('homeNews', $homeNews);
        });
    }
}
