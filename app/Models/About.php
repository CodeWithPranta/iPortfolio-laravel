<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'dynamic_texts',
        'about_short_description',
        'professional_title',
        'profession_description',
        'birthday',
        'age',
        'website',
        'degree',
        'phone',
        'email',
        'address',
        'freelance',
        'about_yourself',
    ];

    protected $casts = ['dynamic_texts'];
}
