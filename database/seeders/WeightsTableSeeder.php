<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            ['name_en' => '50 kg', 'name_ar' => '50 كغ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '60 kg', 'name_ar' => '60 كغ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '70 kg', 'name_ar' => '70 كغ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '80 kg', 'name_ar' => '80 كغ', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => '90 kg', 'name_ar' => '90 كغ', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}