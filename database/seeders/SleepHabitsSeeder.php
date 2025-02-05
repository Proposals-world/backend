<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SleepHabitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sleep_habits')->insert([
            [
                'name_en'    => 'Morning',
                'name_ar'    => 'صباحي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Balanced',
                'name_ar'    => 'متوازن',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Evening',
                'name_ar'    => 'مسائي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}