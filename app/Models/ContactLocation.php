<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactLocation extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'address',
        'email',
        'phone',
    ];
    
    public $translatable = [
        'title',
        'address'
    ];
}