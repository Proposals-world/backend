<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HijabStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('hijab_statuses')->insert([
            ['name_en' => 'Wears Hijab', 'name_ar' => 'ترتدي الحجاب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Does not wear Hijab', 'name_ar' => 'لا ترتدي الحجاب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Occasionally wears Hijab', 'name_ar' => 'ترتدي الحجاب أحيانًا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Prefers not to say', 'name_ar' => 'يفضل عدم القول', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}