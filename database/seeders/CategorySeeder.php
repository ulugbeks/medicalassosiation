<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Biochemistry',
                'slug' => 'biochemistry',
                'description' => 'All about biochemistry research and advances',
            ],
            [
                'name' => 'Pathology',
                'slug' => 'pathology',
                'description' => 'Pathology research and discoveries',
            ],
            [
                'name' => 'Research',
                'slug' => 'research',
                'description' => 'General scientific research articles',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}