<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Buat beberapa user biasa
        User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
    }
}
