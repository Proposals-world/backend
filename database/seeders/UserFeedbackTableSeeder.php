<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserFeedbackTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_feedback')->insert([
            [
                'match_id' => 1, // Assuming User1 and User2 match ID is 1
                'user_id' => 2, // User1
                'is_profile_accurate' => true,
                'feedback_text_en' => 'User2\'s profile was exactly as described.',
                'feedback_text_ar' => 'كان ملف المستخدم 2 مطابقًا تمامًا للوصف.',
                'outcome' => 'Positive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'match_id' => 2, // User1 and User3 match ID is 2
                'user_id' => 2, // User1
                'is_profile_accurate' => false,
                'feedback_text_en' => 'User3 did not match the profile information.',
                'feedback_text_ar' => 'لم يتطابق المستخدم 3 مع معلومات الملف الشخصي.',
                'outcome' => 'Negative',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more feedback entries as needed
        ]);
    }
}