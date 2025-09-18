<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Timeline extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'year',
        'title',
        'description',
        'icon',
    ];
    
    public $translatable = [
        'title',
        'description'
    ];
}