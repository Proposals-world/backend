<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsContentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cms_contents')->insert([
            [
                'page_code' => 'home',
                'content_en' => '<h1>Welcome to Our Dating App</h1><p>Connect with people around the world.</p>',
                'content_ar' => '<h1>مرحبًا بكم في تطبيق المواعدة الخاص بنا</h1><p>تواصل مع أشخاص من جميع أنحاء العالم.</p>',
                'seo_id' => 1, // Assuming 'home' SEO setting has ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_code' => 'about',
                'content_en' => '<h1>About Us</h1><p>Our mission is to help you find love.</p>',
                'content_ar' => '<h1>معلومات عنا</h1><p>مهمتنا هي مساعدتك في العثور على الحب.</p>',
                'seo_id' => 2, // Assuming 'about' SEO setting has ID 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more CMS contents as needed
        ]);
    }
}