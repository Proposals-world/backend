<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->insert([
            ['name_en' => 'Amman', 'name_ar' => 'عمان', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Cairo', 'name_ar' => 'القاهرة', 'country_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Beirut', 'name_ar' => 'بيروت', 'country_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Damascus', 'name_ar' => 'دمشق', 'country_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Ramallah', 'name_ar' => 'رام الله', 'country_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Zarqa', 'name_ar' => 'الزرقاء', 'country_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}