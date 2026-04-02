<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'label',
        'url',
        'target',
        'position',
        'status',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('position');
    }

    public function resolvedUrl(): string
    {
        $url = trim((string) $this->url);

        if ($url === '') {
            return '#';
        }

        if (Str::startsWith($url, ['http://', 'https://', '/', '#'])) {
            return $url;
        }

        $namedRoutes = [
            'gioi-thieu' => 'frontend.about',
            'lien-he' => 'frontend.contact',
            'san-pham' => 'frontend.products',
            'tin-tuc' => 'frontend.news',
        ];

        if (array_key_exists($url, $namedRoutes) && app('router')->has($namedRoutes[$url])) {
            return route($namedRoutes[$url]);
        }

        $productCategory = Category::where('type', 'product')
            ->where('slug', $url)
            ->where('status', 1)
            ->first();

        if ($productCategory && app('router')->has('frontend.products.category')) {
            return route('frontend.products.category', $productCategory->slug);
        }

        $newsCategory = Category::where('type', 'news')
            ->where('slug', $url)
            ->where('status', 1)
            ->first();

        if ($newsCategory && app('router')->has('frontend.news.category')) {
            return route('frontend.news.category', $newsCategory->slug);
        }

        return url($url);
    }
}
