<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('heights')->insert([
            ['name_en' => 'Short', 'name_ar' => 'قصير', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Medium', 'name_ar' => 'متوسط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tall', 'name_ar' => 'طويل', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'Very Tall', 'name_ar' => 'طويل جدًا', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
