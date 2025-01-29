<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPreferredLanguagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_preferred_languages')->insert([
            ['user_id' => 1, 'language_code' => 'en', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'language_code' => 'ar', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'language_code' => 'en', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'language_code' => 'ar', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'language_code' => 'en', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 6, 'language_code' => 'ar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}