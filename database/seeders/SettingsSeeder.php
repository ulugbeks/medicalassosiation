<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'site_name' => 'Labozu',
            'site_title' => 'Laboratory & Science Research',
            'site_description' => 'Laboratory & Science Research HTML5 Template',
            'email' => 'info@example.com',
            'phone' => '(528) 456-7592',
            'address' => '5th Street, 21st Floor, New York, USA',
            'working_hours' => 'Mon - Fri 10:00 to 6:00',
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'whatsapp' => '#',
            'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.840108181602!2d144.95373631539215!3d-37.8172139797516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1497005461921',
            'footer_cta_title' => 'Need help on Emergency? Book Your Appointment Today.',
            'newsletter_text' => 'Subscribe to our newsletter to get the latest updates.',
        ]);
    }
}