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
                'features_en' => 'Access to basic features.',
                'features_ar' => 'الوصول إلى الميزات الأساسية.',
                'price' => 19.99,
                'duration_days' => 30,
                'contact_limit' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_name_en' => 'Premium',
                'package_name_ar' => 'بريميوم',
                'features_en' => 'Access to all features.',
                'features_ar' => 'الوصول إلى جميع الميزات.',
                'price' => 49.99,
                'duration_days' => 90,
                'contact_limit' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_name_en' => 'Gold',
                'package_name_ar' => 'ذهبي',
                'features_en' => 'Unlimited access and premium support.',
                'features_ar' => 'وصول غير محدود ودعم بريميوم.',
                'price' => 99.99,
                'duration_days' => 180,
                'contact_limit' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}