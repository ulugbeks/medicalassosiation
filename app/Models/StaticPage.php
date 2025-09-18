<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StaticPage extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'seo_title',
        'seo_description',
        'active',
        'order'
    ];

    protected $translatable = [
        'title',
        'content', 
        'seo_title',
        'seo_description'
    ];

    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * Get active static pages
     */
    public static function active()
    {
        return static::where('active', true)->orderBy('order');
    }

    /**
     * Get static page by slug
     */
    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->where('active', true)->first();
    }

    /**
     * Get the translated title
     */
    public function getTitle($locale = null)
    {
        return $this->getTranslation('title', $locale ?: app()->getLocale());
    }

    /**
     * Get the translated content
     */
    public function getContent($locale = null)
    {
        return $this->getTranslation('content', $locale ?: app()->getLocale());
    }

    /**
     * Get the translated SEO title
     */
    public function getSeoTitle($locale = null)
    {
        return $this->getTranslation('seo_title', $locale ?: app()->getLocale());
    }

    /**
     * Get the translated SEO description
     */
    public function getSeoDescription($locale = null)
    {
        return $this->getTranslation('seo_description', $locale ?: app()->getLocale());
    }
}