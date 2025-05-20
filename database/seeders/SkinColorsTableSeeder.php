<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkinColorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('skin_colors')->insert([
            ['name_en' => 'Fair', 'name_ar' => 'بيضاء', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medium', 'name_ar' => 'حنطية', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dark', 'name_ar' => 'سمراء', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Very Dark', 'name_ar' => 'داكنة جداً', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
