<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsActivitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sports_activities')->insert([
            ['name_en' => 'Football', 'name_ar' => 'كرة القدم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Swimming', 'name_ar' => 'السباحة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Basketball', 'name_ar' => 'كرة السلة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tennis', 'name_ar' => 'التنس', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Running', 'name_ar' => 'الركض', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}