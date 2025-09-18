<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run()
    {
        About::create([
            'title' => 'Experiment With The Best <span>Lab Test And Service</span>',
            'subtitle' => 'About Us',
            'description' => 'With a belief that knowledge is power, we connect our patients directly with their results so they have valuable health information when they need it most.',
            'image1' => 'images/about/01.jpg',
            'image2' => 'images/about/02.jpg',
            'image3' => 'images/about/08.jpg',
            'signature_image' => 'images/sign.png',
            'doctor_name' => 'Dr. Abigail George',
            'doctor_title' => 'Laboratory Specialist',
            'doctor_image' => 'images/about-thumb.jpg',
            'features' => json_encode([
                'Toxicological assessment',
                'Diagnostic research Facility',
                'Basic Pathology Testing',
                'Biological evaluation'
            ]),
        ]);
    }
}