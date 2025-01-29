<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinkingStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drinking_statuses')->insert([
            ['name_en' => 'Drinks Alcohol', 'name_ar' => 'يشرب الكحول', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Does not drink Alcohol', 'name_ar' => 'لا يشرب الكحول', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Occasionally drinks Alcohol', 'name_ar' => 'يشرب الكحول أحيانًا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Prefers not to say', 'name_ar' => 'يفضل عدم القول', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}