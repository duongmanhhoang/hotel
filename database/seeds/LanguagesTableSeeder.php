<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'flag' => '/uploads/languages/vi.png',
                'name' => 'Tiếng Việt',
                'short' => 'vi',
                'status' => 1
            ],
            [
                'flag' => '/uploads/languages/en.png',
                'name' => 'English',
                'short' => 'en',
                'status' => 1
            ]
        ];
        \App\Models\Language::insert($data);
    }
}
