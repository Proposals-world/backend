<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmokingStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('smoking_statuses')->insert([
            ['status' => 1, 'created_at' => now(), 'updated_at' => now()], // Smokes
            ['status' => 0, 'created_at' => now(), 'updated_at' => now()], // Does not smoke
        ]);
    }
}