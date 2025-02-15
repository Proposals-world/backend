<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('marital_statuses')->insert([
            ['name_en' => 'Single', 'name_ar' => 'أعزب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Widowed', 'name_ar' => 'أرمل', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Divorced Single', 'name_ar' => 'مطلق أعزب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Divorced', 'name_ar' => 'مطلق', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
