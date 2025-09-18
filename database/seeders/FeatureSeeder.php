<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            [
                'title' => 'Microbiology',
                'description' => 'This includes bacteria, viruses, fungi, and parasites.',
                'icon' => 'flaticon flaticon-chemistry-2',
                'link_url' => '#',
                'order' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Histopathology',
                'description' => 'A small piece of lung tissue is removed for analysis.',
                'icon' => 'flaticon flaticon-biochemistry-1',
                'link_url' => '#',
                'order' => 2,
                'active' => 1,
            ],
            [
                'title' => 'Pharmaceutical',
                'description' => 'Accuracy of microbiological quality control tests.',
                'icon' => 'flaticon flaticon-chemistry-4',
                'link_url' => '#',
                'order' => 3,
                'active' => 1,
            ],
            [
                'title' => 'Biochemistry',
                'description' => 'Diagnosis of diseases and the determination of treatment.',
                'icon' => 'flaticon flaticon-biochemistry',
                'link_url' => '#',
                'order' => 4,
                'active' => 1,
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}