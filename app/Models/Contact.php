<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_short_description',
        'email',
        'phone',
        'google_map_link',
        'location',
        'portfolio_short_description',
        'service_short_description',
        'testimonial_short_description',
        'whatsapp',
];
}
