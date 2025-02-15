<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinkingStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drinking_statuses')->insert([
            ['name_en' => 'No', 'name_ar' => 'لا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sometimes', 'name_ar' => 'أحيانًا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Yes', 'name_ar' => 'نعم', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
