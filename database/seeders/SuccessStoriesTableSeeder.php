<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuccessStoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('success_stories')->insert([
            [
                'user_id' => 2, // User1
                'partner_user_id' => 3, // User2
                'story_text_en' => 'We met through the app and have been happily married for two years!',
                'story_text_ar' => 'التقينا من خلال التطبيق ونحن متزوجون بسعادة منذ عامين!',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4, // User3
                'partner_user_id' => 5, // User4
                'story_text_en' => 'Our connection was instant. We support each other in every way.',
                'story_text_ar' => 'اتصالنا كان فوريًا. نحن ندعم بعضنا البعض بكل الطرق.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more success stories as needed
        ]);
    }
}