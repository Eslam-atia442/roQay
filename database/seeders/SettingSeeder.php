<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'phone' => '8484858845855',
            'email' => 'info@roqay-plus.com',
            'logo' => 'uploads/setting/2022031445135258975.png',
            'login_pg' => 'uploads/setting/2022031444820619460.jpg',
            'logo_login' => 'uploads/setting/2022031445026561574.png',
            'location' => null,
            'facebook' => 'https://www.facebook.com',
            'twitter' => null,
            'instagram' => null,
            'pinterest' => null,
            'snapchat' => null,
            'telegram' => null,
            'youtube' => null,
            'site_name' => 'منصة رقي',
            'address' => 'Test',
            'sm_description' => 'small description about application',
            'copyright' => 'جميع الحقوق محفوظة منصة رقي، تنفيذ و تطوير بواسطة رقي',
            'copyright_link_text' => 'منصة رقي',
            'copyright_link' => 'http://www.google.com',
        ];


        Setting::setMany($data);
    }
}
