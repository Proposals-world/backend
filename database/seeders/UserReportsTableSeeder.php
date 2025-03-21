<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserReportsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_reports')->insert([
            [
                'reporter_id' => 2, // User1
                'reported_id' => 3, // User2
                'reason_en' => 'abuse', // Enum option
                'reason_ar' => 'إساءة', // Enum option
                'other_reason_en' => null, // No custom reason for this report
                'other_reason_ar' => null, // No custom reason for this report
                'status' => 'pending', // Enum option
                'report_count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reporter_id' => 4, // User3
                'reported_id' => 5, // User4
                'reason_en' => 'spam', // Enum option
                'reason_ar' => 'رسائل مزعجة', // Enum option
                'other_reason_en' => null, // No custom reason for this report
                'other_reason_ar' => null, // No custom reason for this report
                'status' => 'reviewed', // Enum option
                'report_count' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reporter_id' => 6, // User5
                'reported_id' => 7, // User6
                'reason_en' => 'other', // Enum option for "Other"
                'reason_ar' => 'أخرى', // Enum option for "Other"
                'other_reason_en' => 'Using inappropriate language in comments.', // Custom reason in English
                'other_reason_ar' => 'استخدام لغة غير لائقة في التعليقات.', // Custom reason in Arabic
                'status' => 'pending', // Enum option
                'report_count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
