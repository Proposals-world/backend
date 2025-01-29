<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHobbiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_hobbies')->insert([
            // User 1 has Photography, Gardening, and Cycling
            ['user_id' => 1, 'hobbies_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Photography
            ['user_id' => 1, 'hobbies_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Gardening
            ['user_id' => 1, 'hobbies_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Cycling

            // User 2 has Painting, Hiking, and Cycling
            ['user_id' => 2, 'hobbies_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Painting
            ['user_id' => 2, 'hobbies_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Hiking
            ['user_id' => 2, 'hobbies_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Cycling

            // User 3 has Gardening, Hiking, and Painting
            ['user_id' => 3, 'hobbies_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Gardening
            ['user_id' => 3, 'hobbies_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Hiking
            ['user_id' => 3, 'hobbies_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Painting

            // User 4 has Photography, Painting, and Hiking
            ['user_id' => 4, 'hobbies_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Photography
            ['user_id' => 4, 'hobbies_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Painting
            ['user_id' => 4, 'hobbies_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Hiking

            // User 5 has Cycling, Gardening, and Photography
            ['user_id' => 5, 'hobbies_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Cycling
            ['user_id' => 5, 'hobbies_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Gardening
            ['user_id' => 5, 'hobbies_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Photography
        ]);
    }
}
