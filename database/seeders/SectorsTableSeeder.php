<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sectors')->insert([
            ['name_en' => 'IT', 'name_ar' => 'تكنولوجيا المعلومات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Healthcare', 'name_ar' => 'الرعاية الصحية', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Finance', 'name_ar' => 'المالية', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Education', 'name_ar' => 'التعليم', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}