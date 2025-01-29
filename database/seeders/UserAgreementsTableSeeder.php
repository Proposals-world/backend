<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAgreementsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_agreements')->insert([
            [
                'user_id' => 1,
                'agreement_type' => 'Terms of Service',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'agreement_type' => 'Privacy Policy',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'agreement_type' => 'Terms of Service',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'agreement_type' => 'Privacy Policy',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'agreement_type' => 'Terms of Service',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'agreement_type' => 'Privacy Policy',
                'agreement_version' => '1.0',
                'accepted_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}