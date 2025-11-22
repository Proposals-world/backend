<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsActivitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sports_activities')->insert([
            [
                'name_en'    => 'Not for me',
                'name_ar'    => 'ليست لي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Sometimes',
                'name_ar'    => 'أحيانا',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Regularly',
                'name_ar'    => 'بانتظام',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Always',
                'name_ar'    => 'دائما',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en'    => 'Not for me - little',
                'name_ar'    => 'قليلًا ليس لي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
