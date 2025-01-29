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
                'tool_id' => 1, // Cigarettes
                'smoking_status_id' => 1, // Smokes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tool_id' => 2, // Shisha
                'smoking_status_id' => 1, // Smokes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tool_id' => 3, // E-cigarettes
                'smoking_status_id' => 1, // Smokes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tool_id' => 4, // Other
                'smoking_status_id' => 1, // Does not smoke
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}