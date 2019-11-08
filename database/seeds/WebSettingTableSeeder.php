<?php

use Illuminate\Database\Seeder;

class WebSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	'logo' => 'lymacsau',
            'facebook' => 'http://facebook.com',
            'twitter' => 'https://twitter.com/',
            'instagram' => 'https://www.instagram.com/',
            'linkedin' => 'https://www.linkedin.com/',
            'tripadvisor' => 'https://www.tripadvisor.com.vn',
            'logo_footer' => 'logo',
        ];
        \App\Models\WebSetting::insert($data);
    }
}
