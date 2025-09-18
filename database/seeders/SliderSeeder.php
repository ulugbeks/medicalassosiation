<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $sliders = [
            [
                'title' => 'High Laboratory <span>Quality Service</span>',
                'subtitle' => 'Lab Research Excellence',
                'description' => 'Welcome to our research laboratory center, where groundbreaking research meets practical applications. We bring together diverse expertise to tackle global issues.',
                'image_path' => 'images/banner/01.jpg',
                'primary_button_text' => 'Explore More',
                'primary_button_url' => '/about-us',
                'secondary_button_text' => 'Contact Us',
                'secondary_button_url' => '/contact',
                'order' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Reliable & High <span>Quality Service</span>',
                'subtitle' => 'Lab Research Excellence',
                'description' => 'Welcome to our research laboratory center, where groundbreaking research meets practical applications. We bring together diverse expertise to tackle global issues.',
                'image_path' => 'images/banner/08.jpg',
                'primary_button_text' => 'Explore More',
                'primary_button_url' => '/about-us',
                'secondary_button_text' => 'Contact Us',
                'secondary_button_url' => '/contact',
                'order' => 2,
                'active' => 1,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}