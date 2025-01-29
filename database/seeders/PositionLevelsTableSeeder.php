<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionLevelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('position_levels')->insert([
            ['name_en' => 'Entry Level', 'name_ar' => 'مستوى الدخول', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mid Level', 'name_ar' => 'المستوى المتوسط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Senior Level', 'name_ar' => 'المستوى الأعلى', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Manager', 'name_ar' => 'مدير', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}