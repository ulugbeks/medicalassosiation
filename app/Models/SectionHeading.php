<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SectionHeading extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'section_key',
        'subtitle',
        'title',
        'title_span'
    ];

    public $translatable = [
        'subtitle',
        'title',
        'title_span'
    ];
}