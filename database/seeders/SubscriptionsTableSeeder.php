<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscriptions')->insert([
            [
                'user_id' => 1,
                'package_id' => 2, // Premium

                'contacts_remaining' => 50,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'package_id' => 1, // Basic

                'contacts_remaining' => 10,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'user_id' => 3,
            //     'package_id' => 3, // Gold
            //     'start_date' => now(),
            //     'end_date' => now()->addDays(180),
            //     'contacts_remaining' => 100,
            //     'status' => 'active',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 4,
            //     'package_id' => 1, // Basic
            //     'start_date' => now(),
            //     'end_date' => now()->addDays(30),
            //     'contacts_remaining' => 10,
            //     'status' => 'active',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 5,
            //     'package_id' => 2, // Premium
            //     'start_date' => now(),
            //     'end_date' => now()->addDays(90),
            //     'contacts_remaining' => 50,
            //     'status' => 'active',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 6,
            //     'package_id' => 1, // Basic
            //     'start_date' => now(),
            //     'end_date' => now()->addDays(30),
            //     'contacts_remaining' => 10,
            //     'status' => 'active',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}