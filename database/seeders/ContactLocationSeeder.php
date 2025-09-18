<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactLocation;

class ContactLocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            [
                'title' => 'Australia',
                'address' => '5th Street, 21st Floor, New York, USA',
                'email' => 'themeht23@gmail.com',
                'phone' => '+91-234-567-8900',
            ],
            [
                'title' => 'New York',
                'address' => '5th Street, 21st Floor, New York, USA',
                'email' => 'themeht23@gmail.com',
                'phone' => '+91-234-567-8900',
            ],
            [
                'title' => 'India',
                'address' => '5th Street, 21st Floor, New York, USA',
                'email' => 'themeht23@gmail.com',
                'phone' => '+91-234-567-8900',
            ],
        ];

        foreach ($locations as $location) {
            ContactLocation::create($location);
        }
    }
}