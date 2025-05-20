<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPhotosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_photos')->insert([
            [
                'user_id' => 1, // Admin
                'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'caption_en' => 'Admin Profile Picture',
                'caption_ar' => 'صورة الملف الشخصي للمدير',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // User1
                'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                'caption_en' => 'Enjoying a sunny day.',
                'caption_ar' => 'أستمتع بيوم مشمس.',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'user_id' => 3, // User2
            //     'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            //     'caption_en' => 'Hiking in the mountains.',
            //     'caption_ar' => 'التسلق في الجبال.',
            //     'is_verified' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 4, // User3
            //     'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            //     'caption_en' => 'At the beach.',
            //     'caption_ar' => 'على الشاطئ.',
            //     'is_verified' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 5, // User4
            //     'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            //     'caption_en' => 'Cooking a new recipe.',
            //     'caption_ar' => 'يطبخ وصفة جديدة.',
            //     'is_verified' => false,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 6, // User5
            //     'photo_url' => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            //     'caption_en' => 'Loving my pet cat.',
            //     'caption_ar' => 'أحب قطتي الأليفة.',
            //     'is_verified' => true,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // Add more user photos as needed
        ]);
    }
}