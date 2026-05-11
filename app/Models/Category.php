<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'type',
        'name',
        'slug',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getFrontendUrlAttribute(): string
    {
        return url($this->slug);
    }

    public function descendantIds(): array
    {
        $children = $this->relationLoaded('children')
            ? $this->children
            : $this->children()->get();

        $ids = $children->pluck('id')->all();

        foreach ($children as $child) {
            $ids = array_merge($ids, $child->descendantIds());
        }

        return array_values(array_unique($ids));
    }
}
