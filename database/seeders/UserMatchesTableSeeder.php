<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMatchesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_matches')->insert([
            [
                'user1_id' => 2, // User1 matches with User2
                'user2_id' => 3,
                'match_gender' => 'female',
                'match_percentage' => 90,
                'match_status' => 'accepted',
                'contact_exchanged' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user1_id' => 2, // User1 matches with User3
                'user2_id' => 4,
                'match_gender' => 'male',
                'match_percentage' => 75,
                'match_status' => 'pending',
                'contact_exchanged' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user1_id' => 3, // User2 matches with User4
                'user2_id' => 5,
                'match_gender' => 'female',
                'match_percentage' => 85,
                'match_status' => 'accepted',
                'contact_exchanged' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user1_id' => 4, // User3 matches with User5
                'user2_id' => 6,
                'match_gender' => 'female',
                'match_percentage' => 65,
                'match_status' => 'rejected',
                'contact_exchanged' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user1_id' => 5, // User4 matches with User1
                'user2_id' => 2,
                'match_gender' => 'male',
                'match_percentage' => 80,
                'match_status' => 'accepted',
                'contact_exchanged' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user1_id' => 6, // User5 matches with User3
                'user2_id' => 4,
                'match_gender' => 'male',
                'match_percentage' => 70,
                'match_status' => 'pending',
                'contact_exchanged' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}