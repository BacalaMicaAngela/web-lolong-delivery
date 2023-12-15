<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'u_name' => 'Test User',
            'username' => 'admin',
            'userType' => 'admin',
            'password' => bcrypt('admin'),
            'user_avatar' => 'default.jpg',
            'status' => '0'
        ]);
    }
}
