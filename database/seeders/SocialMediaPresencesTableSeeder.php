<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaPresencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('social_media_presences')->insert([
            ['id' => 1, 'name_en' => 'No Social Media', 'name_ar' => 'لا يوجد وسائل تواصل اجتماعي', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name_en' => 'Yes', 'name_ar' => 'نعم', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}