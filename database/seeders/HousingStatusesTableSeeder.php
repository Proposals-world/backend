<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousingStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('housing_statuses')->insert([
            ['name_en' => 'Owned', 'name_ar' => 'تمتلك', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Rented', 'name_ar' => 'مستأجرة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Living with Parents', 'name_ar' => 'يعيش مع الوالدين', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}