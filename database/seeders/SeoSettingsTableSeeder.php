<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSettingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('seo_settings')->insert([
            [
                'page_code' => 'home',
                'meta_title_en' => 'Find Your Perfect Match | Dating App',
                'meta_title_ar' => 'اعثر على شريكك المثالي | تطبيق المواعدة',
                'meta_description_en' => 'Join our dating app to connect with like-minded individuals.',
                'meta_description_ar' => 'انضم إلى تطبيق المواعدة الخاص بنا للتواصل مع أفراد متشابهين في التفكير.',
                'meta_keywords_en' => 'dating, love, relationships, singles',
                'meta_keywords_ar' => 'مواعدة, حب, علاقات, عزاب',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_code' => 'about',
                'meta_title_en' => 'About Us | Dating App',
                'meta_title_ar' => 'معلومات عنا | تطبيق المواعدة',
                'meta_description_en' => 'Learn more about our mission and values.',
                'meta_description_ar' => 'تعرف أكثر على مهمتنا وقيمنا.',
                'meta_keywords_en' => 'about, mission, values, team',
                'meta_keywords_ar' => 'معلومات, مهمة, قيم, فريق',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more SEO settings as needed
        ]);
    }
}