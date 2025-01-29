<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('religions')->insert([
            ['name_en' => 'Islam', 'name_ar' => 'الإسلام', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Christianity', 'name_ar' => 'المسيحية', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}