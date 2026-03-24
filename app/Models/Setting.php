<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'short_intro',
        'address',
        'hotline',
        'zalo',
        'email',
        'logo',
        'footer_logo',
        'favicon',
        'facebook',
        'youtube',
        'tiktok',
        'instagram',
        'twitter',
        'linkedin',
    ];
}
