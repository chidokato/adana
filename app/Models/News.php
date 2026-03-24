<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'seo_description',
        'description',
        'content',
        'thumbnail',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
