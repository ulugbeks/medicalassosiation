<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public $translatable = [
        'name',
        'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}