<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_short_description',
        'text_after_name',
        'resume_contact_lists',
        'educations',
        'experiences',
    ];

    protected $casts = [
        'resume_contact_lists',
        'educations',
        'experiences',
    ];
}
