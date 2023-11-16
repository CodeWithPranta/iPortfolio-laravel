<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

     protected $fillable = [
        'featured_image',
        'title',
        'slug',
        'category_id',
        'content',
        'meta_description',
        'keywords',
     ];

   public function category(): BelongsTo
   {
    return $this->belongsTo(Category::class);
   }
}
