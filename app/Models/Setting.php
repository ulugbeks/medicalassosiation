<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'site_name',
        'site_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'logo',
        'logo_white',
        'favicon',
        'email',
        'phone',
        'address',
        'working_hours',
        'facebook',
        'twitter',
        'linkedin',
        'whatsapp',
        'map_url',
        'footer_cta_title',
        'newsletter_text',
    ];
    
    public $translatable = [
        'site_name',
        'site_title',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'address',
        'working_hours',
        'footer_cta_title',
        'newsletter_text'
    ];
}