<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timeline;

class TimelineSeeder extends Seeder
{
    public function run()
    {
        $timeline = [
            [
                'year' => '2022',
                'title' => 'Laboratory Specialist',
                'description' => 'A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has been the industry\'s standard dummy text. Employ global development standards: Lorem ipsum dolorcon sectetur adipiscing elitut.',
                'icon' => 'flaticon flaticon-microscope',
            ],
            [
                'year' => '2023',
                'title' => 'Unique Features',
                'description' => 'A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has been the industry\'s standard dummy text. Employ global development standards: Lorem ipsum dolorcon sectetur adipiscing elitut.',
                'icon' => 'flaticon flaticon-microscope',
            ],
            [
                'year' => '2024',
                'title' => 'Layout Option',
                'description' => 'A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has been the industry\'s standard dummy text. Employ global development standards: Lorem ipsum dolorcon sectetur adipiscing elitut.',
                'icon' => 'flaticon flaticon-microscope',
            ],
            [
                'year' => '2025',
                'title' => 'Fully Responsive',
                'description' => 'A seamless UI experience: Lorem Ipsum is simply of the printing typesetting has been the industry\'s standard dummy text. Employ global development standards: Lorem ipsum dolorcon sectetur adipiscing elitut.',
                'icon' => 'flaticon flaticon-microscope',
            ],
        ];

        foreach ($timeline as $item) {
            Timeline::create($item);
        }
    }
}