<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image1',
        'image2',
        'image3',
        'signature_image',
        'doctor_name',
        'doctor_title',
        'doctor_image',
        'features',
        'second_section_subtitle',
        'second_section_title',
        'second_section_description',
        'second_section_years',
        'second_section_feature1_title',
        'second_section_feature1_description',
        'second_section_feature2_title',
        'second_section_feature2_description',
    ];

    public $translatable = [
        'title',
        'subtitle',
        'description',
        'doctor_name',
        'doctor_title',
        'second_section_subtitle',
        'second_section_title',
        'second_section_description',
        'second_section_feature1_title',
        'second_section_feature1_description',
        'second_section_feature2_title',
        'second_section_feature2_description'
    ];
}