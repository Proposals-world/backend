<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLogsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_logs')->insert([
            [
                'user_id' => 1, // Admin
                'action' => 'Login',
                'description_en' => 'Admin logged in from IP 192.168.1.1.',
                'description_ar' => 'قام المدير بتسجيل الدخول من IP 192.168.1.1.',
                'timestamp' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // User1
                'action' => 'Update Profile',
                'description_en' => 'User1 updated their bio.',
                'description_ar' => 'قام المستخدم 1 بتحديث سيرته الذاتية.',
                'timestamp' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more user logs as needed
        ]);
    }
}