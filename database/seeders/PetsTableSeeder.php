<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pets')->insert([
            ['name_en' => 'Cat', 'name_ar' => 'قط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Dog', 'name_ar' => 'كلب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bird', 'name_ar' => 'طائر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Fish', 'name_ar' => 'سمك', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}