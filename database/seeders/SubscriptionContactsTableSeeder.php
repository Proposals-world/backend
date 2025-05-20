<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionContactsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscription_contacts')->insert([
            [
                'subscription_id' => 1, // Admin's Premium subscription
                'contact_user_id' => 2, // User1
                'accessed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'subscription_id' => 1,
            //     'contact_user_id' => 3, // User2
            //     'accessed_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'subscription_id' => 2, // User1's Basic subscription
                'contact_user_id' => 4, // User3
                'accessed_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'subscription_id' => 3, // User2's Gold subscription
            //     'contact_user_id' => 5, // User4
            //     'accessed_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'subscription_id' => 4, // User3's Basic subscription
            //     'contact_user_id' => 6, // User5
            //     'accessed_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'subscription_id' => 5, // User4's Premium subscription
            //     'contact_user_id' => 2, // User1
            //     'accessed_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'subscription_id' => 6, // User5's Basic subscription
            //     'contact_user_id' => 4, // User3
            //     'accessed_at' => now(),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}