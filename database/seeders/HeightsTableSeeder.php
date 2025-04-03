<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('heights')->insert([
            ['name_en' => '140-150', 'name_ar' => '١٤٠-١٥٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '150-160', 'name_ar' => '١٥٠-١٦٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '160-170', 'name_ar' => '١٦٠-١٧٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '170-180', 'name_ar' => '١٧٠-١٨٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '180-190', 'name_ar' => '١٨٠-١٩٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '190-200', 'name_ar' => '١٩٠-٢٠٠', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '200-210', 'name_ar' => '٢٠٠-٢١٠', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
