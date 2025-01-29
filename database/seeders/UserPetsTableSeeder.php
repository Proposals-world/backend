<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_pets')->insert([
            // Admin (user_id = 1) gets 3 pets
            ['user_id' => 1, 'pet_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Cat
            ['user_id' => 1, 'pet_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Dog
            ['user_id' => 1, 'pet_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Bird
            
            // User1 (user_id = 2) gets 3 pets
            ['user_id' => 2, 'pet_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Fish
            ['user_id' => 2, 'pet_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Other
            ['user_id' => 2, 'pet_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Cat
            
            // User2 (user_id = 3) gets 3 pets
            ['user_id' => 3, 'pet_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Dog
            ['user_id' => 3, 'pet_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Bird
            ['user_id' => 3, 'pet_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Fish
            
            // User3 (user_id = 4) gets 3 pets
            ['user_id' => 4, 'pet_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Other
            ['user_id' => 4, 'pet_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Cat
            ['user_id' => 4, 'pet_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Dog
            
            // User4 (user_id = 5) gets 3 pets
            ['user_id' => 5, 'pet_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Bird
            ['user_id' => 5, 'pet_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Fish
            ['user_id' => 5, 'pet_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Other
            
            // User5 (user_id = 6) gets 3 pets
            ['user_id' => 6, 'pet_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Cat
            ['user_id' => 6, 'pet_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Dog
            ['user_id' => 6, 'pet_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Bird
        ]);
    }
}
