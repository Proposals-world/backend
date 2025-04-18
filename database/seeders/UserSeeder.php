<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Seed Admin user
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@proposals.world',
            'phone_number' => '1234567890',
            'password' => Hash::make('password'),
            'profile_status' => 'active',
            'gender' => 'male',
            'status' => 'active',
            'role_id' => 1, // Admin role
            'created_at' => now(),
            'updated_at' => now(),
            'otp_expires_at' => now(),
            'email_verified_at' => now(),
        ]);

        // User Accounts
        DB::table('users')->insert([
            [
                'first_name' => 'User1',
                'last_name' => 'Example',
                'email' => 'user1@proposals.world',
                'phone_number' => '1111111111',
                'password' => Hash::make('password'),
                'profile_status' => 'active',
                'gender' => 'female',
                'status' => 'active',
                'role_id' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
                'otp_expires_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'User2',
                'last_name' => 'Example',
                'email' => 'user2@proposals.world',
                'phone_number' => '2222222222',
                'password' => Hash::make('password'),
                'profile_status' => 'active',
                'gender' => 'male',
                'status' => 'active',
                'role_id' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
                'otp_expires_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'User3',
                'last_name' => 'Example',
                'email' => 'user3@proposals.world',
                'phone_number' => '3333333333',
                'password' => Hash::make('password'),
                'profile_status' => 'active',
                'gender' => 'female',
                'status' => 'active',
                'role_id' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
                'otp_expires_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'User4',
                'last_name' => 'Example',
                'email' => 'user4@proposals.world',
                'phone_number' => '4444444444',
                'password' => Hash::make('password'),
                'profile_status' => 'active',
                'gender' => 'male',
                'status' => 'active',
                'role_id' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
                'otp_expires_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'User5',
                'last_name' => 'Example',
                'email' => 'user5@proposals.world',
                'phone_number' => '5555555555',
                'password' => Hash::make('password'),
                'profile_status' => 'active',
                'gender' => 'female',
                'status' => 'active',
                'role_id' => 2, // User role
                'created_at' => now(),
                'updated_at' => now(),
                'otp_expires_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);
        User::factory(100)->create()->each(function ($user) {
            UserProfile::factory()->create([
                'id' => $user->id,
            ]);
        });
    }
}
