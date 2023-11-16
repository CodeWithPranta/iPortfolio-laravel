<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'background_image',
        'title',
        'meta_description',
        'keywords',
        'social_links',
        'favicon',
        'apple_touch_icon',
    ];

    protected $casts = [
        'social_links',
    ];
}
