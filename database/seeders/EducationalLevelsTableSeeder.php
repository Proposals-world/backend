<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalLevelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('educational_levels')->insert([
            ['name_en' => 'No Preference', 'name_ar' => 'لا تفضيل', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'High School', 'name_ar' => 'اقل من توجيهي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'High School Diploma', 'name_ar' => 'توجيهي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Vocational Degree', 'name_ar' => 'تخصص مهني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Diploma', 'name_ar' => 'دبلوم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Higher Diploma', 'name_ar' => 'دبلوم عالي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bachelor\'s Degree', 'name_ar' => 'درجة البكالوريوس', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Master\'s Degree', 'name_ar' => 'درجة الماجستير', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'PhD', 'name_ar' => 'دكتوراه', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
