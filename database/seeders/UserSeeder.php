<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@proposals.world',
            'phone_number' => '1234567890',
            'password' => Hash::make('password'), // Replace with a secure password
            'profile_status' => 'active',
            'gender' => 'male',
            'status' => 'active',
            'role_id' => 1, // Admin role
        ]);

        // Seed User
        User::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@proposals.world',
            'phone_number' => '0987654321',
            'password' => Hash::make('password'), // Replace with a secure password
            'profile_status' => 'active',
            'gender' => 'female',
            'status' => 'active',
            'role_id' => 2, // User role
        ]);
    }
}