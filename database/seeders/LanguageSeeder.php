<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            [
                'code' => 'en',
                'name' => 'English',
                'active' => true,
                'is_default' => true
            ],
            [
                'code' => 'lv',
                'name' => 'Latvian',
                'active' => true,
                'is_default' => false
            ],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}