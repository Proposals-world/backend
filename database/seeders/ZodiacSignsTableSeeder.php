<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZodiacSignsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('zodiac_signs')->insert([
            ['name_en' => 'Aries', 'name_ar' => 'الحمل', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Taurus', 'name_ar' => 'الثور', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Gemini', 'name_ar' => 'الجوزاء', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Cancer', 'name_ar' => 'السرطان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Leo', 'name_ar' => 'الأسد', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Virgo', 'name_ar' => 'العذراء', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Libra', 'name_ar' => 'الميزان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Scorpio', 'name_ar' => 'العقرب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sagittarius', 'name_ar' => 'القوس', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Capricorn', 'name_ar' => 'الجدي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Aquarius', 'name_ar' => 'الدلو', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Pisces', 'name_ar' => 'الحوت', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}