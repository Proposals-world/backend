<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalLevelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('educational_levels')->insert([
            ['name_en' => 'High School', 'name_ar' => 'الثانوية', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bachelor\'s Degree', 'name_ar' => 'درجة البكالوريوس', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Master\'s Degree', 'name_ar' => 'درجة الماجستير', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'PhD', 'name_ar' => 'دكتوراه', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}