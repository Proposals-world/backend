<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('nationalities')->insert([
            ['name_en' => 'Jordanian', 'name_ar' => 'أردني', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
