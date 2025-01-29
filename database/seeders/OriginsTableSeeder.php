<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('origins')->insert([
            ['name_en' => 'Middle Eastern', 'name_ar' => 'شرق أوسطي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'African', 'name_ar' => 'أفريقي', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}