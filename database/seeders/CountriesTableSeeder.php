<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->insert([
            ['name_en' => 'Jordan', 'name_ar' => 'الأردن', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Lebanon', 'name_ar' => 'لبنان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Syria', 'name_ar' => 'سوريا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Palestine', 'name_ar' => 'فلسطين', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}