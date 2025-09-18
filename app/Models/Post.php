<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'seo_title',
        'seo_description',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category_id',
        'active',
        'author_name',
        'author_link',
    ];

    public $translatable = [
        'title',
        'seo_title',
        'seo_description',
        'excerpt',
        'content',
        'author_name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}