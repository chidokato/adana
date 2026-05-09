<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'description',
        'content',
        'image',
        'sub_image',
        'note',
    ];
}
