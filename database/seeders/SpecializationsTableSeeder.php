<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('specializations')->insert([
            ['name_en' => 'Computer Science', 'name_ar' => 'علوم الحاسوب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Engineering', 'name_ar' => 'الهندسة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Business Administration', 'name_ar' => 'إدارة الأعمال', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medicine', 'name_ar' => 'الطب', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}