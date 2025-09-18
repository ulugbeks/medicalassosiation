<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'icon',
        'order',
        'active',
    ];

    // Add the translatable fields
    public $translatable = [
        'title',
        'description',
        'content'
    ];
}