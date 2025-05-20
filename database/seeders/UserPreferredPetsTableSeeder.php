<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPreferredPetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_preferred_pets')->insert([
            ['user_id' => 1, 'pet_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'pet_id' => 2, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}