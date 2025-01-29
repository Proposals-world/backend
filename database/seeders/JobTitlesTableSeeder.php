<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTitlesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('job_titles')->insert([
            ['name_en' => 'Software Engineer', 'name_ar' => 'مهندس برمجيات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Data Analyst', 'name_ar' => 'محلل بيانات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Project Manager', 'name_ar' => 'مدير مشروع', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Doctor', 'name_ar' => 'طبيب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Business Analyst', 'name_ar' => 'محلل أعمال', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}