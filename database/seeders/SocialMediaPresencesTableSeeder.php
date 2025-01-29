<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaPresencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('social_media_presences')->insert([
            ['name_en' => 'Instagram', 'name_ar' => 'إنستغرام', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Facebook', 'name_ar' => 'فيسبوك', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Twitter', 'name_ar' => 'تويتر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'LinkedIn', 'name_ar' => 'لينكد إن', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Snapchat', 'name_ar' => 'سناب شات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Other', 'name_ar' => 'أخرى', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}