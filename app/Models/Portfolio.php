<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'featured_image',
        'slider_photos',
        'category',
        'client',
        'project_date',
        'project_link',
        'project_details',
    ];

    protected $casts = ['slider_photos' => 'array'];
}
