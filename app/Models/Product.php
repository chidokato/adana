<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'product_code',
        'price',
        'category_id',
        'seo_title',
        'seo_description',
        'description',
        'content',
        'thumbnail',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getFrontendUrlAttribute(): string
    {
        if (!empty(optional($this->category)->slug)) {
            return url($this->category->slug . '/' . $this->slug);
        }

        return url('san-pham/' . $this->slug);
    }
}
