<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkinColorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('skin_colors')->insert([
            ['name_en' => 'Fair', 'name_ar' => 'فاتح', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medium', 'name_ar' => 'متوسط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dark', 'name_ar' => 'غامق', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}