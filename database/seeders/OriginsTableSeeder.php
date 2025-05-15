<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('origins')->insert([
            // ['name_en' => 'Middle Eastern', 'name_ar' => 'شرق أوسطي', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'African', 'name_ar' => 'أفريقي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jordan', 'name_ar' => 'أردني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Palestinian', 'name_ar' => 'فلسطيني', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Syrian', 'name_ar' => 'سوري', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kurdish', 'name_ar' => 'كردي', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
