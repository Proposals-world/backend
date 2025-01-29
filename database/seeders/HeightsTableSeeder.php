<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('heights')->insert([
            ['name_en' => '150 cm', 'name_ar' => '150 سم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '160 cm', 'name_ar' => '160 سم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '170 cm', 'name_ar' => '170 سم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '180 cm', 'name_ar' => '180 سم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '190 cm', 'name_ar' => '190 سم', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}