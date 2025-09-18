<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactPageSeo extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'contact_page_seo';

    protected $fillable = [
        'seo_title',
        'seo_description',
    ];
    
    public $translatable = [
        'seo_title',
        'seo_description'
    ];
}