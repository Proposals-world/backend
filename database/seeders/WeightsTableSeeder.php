<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            ['name_en' => 'Slim', 'name_ar' => 'نحيف', 'weight_kg' => '50 kg', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Average', 'name_ar' => 'متوسط', 'weight_kg' => '60 kg', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Chubby', 'name_ar' => 'ممتلئ', 'weight_kg' => '70 kg', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Overweight', 'name_ar' => 'ممتلئ جداً', 'weight_kg' => '80 kg', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Overweight+', 'name_ar' => 'ممتلئ جداً', 'weight_kg' => '90 kg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
