<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'title',
        'image',
        'facebook',
        'twitter',
        'linkedin',
        'order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public $translatable = [
        'name',
        'title'
    ];
}