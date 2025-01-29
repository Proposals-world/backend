<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('nationalities')->insert([
            ['name_en' => 'Jordanian', 'name_ar' => 'أردني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Egyptian', 'name_ar' => 'مصري', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Lebanese', 'name_ar' => 'لبناني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Syrian', 'name_ar' => 'سوري', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Palestinian', 'name_ar' => 'فلسطيني', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}