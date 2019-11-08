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
                'email' => 'minhku98@gmail.com',
                'password' => bcrypt('123456'),
                'full_name' => 'Super Admin',
                'phone' => '0969200973',
                'address' => 'Hà Nội',
                'remember_token' => bcrypt(uniqid()),
                'is_active' => config('common.active.is_active'),
            ]
        ];

        \App\Models\User::insert($data);
    }
}
