<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaPresencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('social_media_presences')->insert([
            ['id' => 1, 'name_en' => 'Not for Me', 'name_ar' => 'ليست لي', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name_en' => 'Somewhat', 'name_ar' => 'نوعا ما', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name_en' => 'Active', 'name_ar' => 'نشط', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name_en' => 'Necessary Presence', 'name_ar' => 'لي ظهور ضروري فيها', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
