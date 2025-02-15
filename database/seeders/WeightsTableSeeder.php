<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            ['name_en' => 'Slim', 'name_ar' => 'نحيف',  'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Average', 'name_ar' => 'متوسط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Chubby', 'name_ar' => 'ممتلئ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Overweight', 'name_ar' => 'ممتلئ جداً', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Overweight+', 'name_ar' => 'ممتلئ جداً', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
