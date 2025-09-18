<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AppointmentSetting extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'working_hours',
        'active',
    ];

    protected $casts = [
        'working_hours' => 'json',
        'active' => 'boolean',
    ];
    
    public $translatable = [
        'title',
        'subtitle',
        'description',
        'button_text'
    ];
}