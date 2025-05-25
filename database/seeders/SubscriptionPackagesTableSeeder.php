<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPackagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscription_packages')->insert([
            [
                'package_name_en' => 'Basic',
                'package_name_ar' => 'أساسي',

                'price' => 9.99,
                'contact_limit' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_name_en' => 'Premium',
                'package_name_ar' => 'بريميوم',

                'price' => 11.99,
                'contact_limit' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_name_en' => 'Gold',
                'package_name_ar' => 'ذهبي',

                'price' => 29.99,
                'contact_limit' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
