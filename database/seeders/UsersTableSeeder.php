<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'username' => 'AdminUser',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $user1 = User::create([
            'username' => 'UserOne',
            'email' => 'user1@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'username' => 'UserTwo',
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $user3 = User::create([
            'username' => 'UserThree',
            'email' => 'user3@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        // Power of friendship
        $user1->friends()->attach($user2->id, ['status' => 1]);
        $user2->friends()->attach($user1->id, ['status' => 1]);
        $user3->friends()->attach($admin->id, ['status' => 1]);
        $admin->friends()->attach($user3->id, ['status' => 1]);
    }
}
