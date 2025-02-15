<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmokingToolsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('smoking_tools')->insert([
            ['name_en' => 'Cigarettes', 'name_ar' => 'سجائر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Shisha', 'name_ar' => 'شيشة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'E-cigarettes', 'name_ar' => 'السيجار الإلكتروني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Vape', 'name_ar' => 'فاپ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
