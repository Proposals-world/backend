<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HairColorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('hair_colors')->insert([
            ['name_en' => 'Black', 'name_ar' => 'أسود', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Brown', 'name_ar' => 'بني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Blonde', 'name_ar' => 'أشقر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hijab', 'name_ar' => 'محجبة', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
