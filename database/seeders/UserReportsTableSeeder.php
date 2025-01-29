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
                'reason_en' => 'Inappropriate behavior.',
                'reason_ar' => 'سلوك غير لائق.',
                'status' => 'pending',
                'report_count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reporter_id' => 4, // User3
                'reported_id' => 5, // User4
                'reason_en' => 'Spam messages.',
                'reason_ar' => 'رسائل غير مرغوب فيها.',
                'status' => 'reviewed',
                'report_count' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}