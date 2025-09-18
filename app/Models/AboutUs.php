<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'additional_title',
        'additional_description',
        'seo_title',  
        'seo_description', 
    ];
    
    public $translatable = [
        'title',
        'subtitle',
        'description',
        'additional_title',
        'additional_description',
        'seo_title',
        'seo_description'
    ];
}