<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSmokingToolPivotsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_smoking_tool_pivots')->insert([
            [
                'user_profile_id' => 1,
                'tool_id' => 1, // Cigarettes

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_profile_id' => 2,
                'tool_id' => 2, // Shisha

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_profile_id' => 3,
                'tool_id' => 3, // E-cigarettes

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_profile_id' => 4,
                'tool_id' => 4, // Other

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}