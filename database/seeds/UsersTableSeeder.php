<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'role_id' => config('common.roles.super_admin'),
                'email' => 'manhhoang3151996@gmail.com',
                'password' => bcrypt('12345678'),
                'full_name' => 'Super Admin',
                'phone' => '0969200973',
                'address' => 'Hà Nội',
                'remember_token' => bcrypt(uniqid()),
                'is_active' => config('common.active.is_active'),
            ],
            [
                'role_id' => config('common.roles.super_admin'),
                'email' => 'maiduynghia87@gmail.com',
                'password' => bcrypt('12345678'),
                'full_name' => 'Super Admin',
                'phone' => '0969200973',
                'address' => 'Thanh Hóa',
                'remember_token' => bcrypt(uniqid()),
                'is_active' => config('common.active.is_active'),
            ]
        ];

        \App\Models\User::insert($data);
    }
}
