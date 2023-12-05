<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'u_name' => 'Duke Dayata', 
            'username' => 'admin', 
            'password' => Hash::make('admin'), 
            'userType' => 0,
            'user_avatar' => 'avatar_0.94692400 1686462356.png',
            'status' => 0
        ]);

        User::create([
            'u_name' => 'Niel Pa nga', 
            'username' => 'niel', 
            'password' => Hash::make('niel'), 
            'userType' => 0,
            'user_avatar' => 'avatar_0.94692400 1686462356.png',
            'status' => 0
        ]);

        User::create([
            'u_name' => 'Mark G', 
            'username' => 'markG', 
            'password' => Hash::make('mark'), 
            'userType' => 1,
            'user_avatar' => 'avatar_0.94692400 1686462356.png',
            'status' => 0
        ]);
    }
}