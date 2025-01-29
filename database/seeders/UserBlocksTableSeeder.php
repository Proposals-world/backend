<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBlocksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_blocks')->insert([
            [
                'blocker_id' => 2, // User1
                'blocked_id' => 4, // User3
                'block_start_time' => now(),
                'block_end_time' => now()->addDays(7),
                'reason_en' => 'Harassment.',
                'reason_ar' => 'تحرش.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blocker_id' => 5, // User4
                'blocked_id' => 6, // User5
                'block_start_time' => now(),
                'block_end_time' => null, // Permanent block
                'reason_en' => 'Offensive language.',
                'reason_ar' => 'لغة مسيئة.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more blocks as needed
        ]);
    }
}