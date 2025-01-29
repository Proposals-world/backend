<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HobbiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('hobbies')->insert([
            ['name_en' => 'Photography', 'name_ar' => 'التصوير', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gardening', 'name_ar' => 'البستنة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Painting', 'name_ar' => 'الرسم', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Cycling', 'name_ar' => 'ركوب الدراجات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Hiking', 'name_ar' => 'المشي لمسافات طويلة', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}