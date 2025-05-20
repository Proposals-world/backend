<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('origins')->insert([
            // ['name_en' => 'Middle Eastern', 'name_ar' => 'شرق أوسطي', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'African', 'name_ar' => 'أفريقي', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'Jordan', 'name_ar' => 'أردني', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'Palestinian', 'name_ar' => 'فلسطيني', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'Syrian', 'name_ar' => 'سوري', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => 'Kurdish', 'name_ar' => 'كردي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jordan', 'name_ar' => 'الأردن', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Lebanon', 'name_ar' => 'لبنان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Syria', 'name_ar' => 'سوريا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Palestine', 'name_ar' => 'فلسطين', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Iraq', 'name_ar' => 'العراق', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Saudi Arabia', 'name_ar' => 'السعودية', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'United Arab Emirates', 'name_ar' => 'الإمارات', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kuwait', 'name_ar' => 'الكويت', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Qatar', 'name_ar' => 'قطر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bahrain', 'name_ar' => 'البحرين', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Oman', 'name_ar' => 'عمان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Yemen', 'name_ar' => 'اليمن', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sudan', 'name_ar' => 'السودان', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Libya', 'name_ar' => 'ليبيا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tunisia', 'name_ar' => 'تونس', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Algeria', 'name_ar' => 'الجزائر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Morocco', 'name_ar' => 'المغرب', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mauritania', 'name_ar' => 'موريتانيا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Somalia', 'name_ar' => 'الصومال', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Djibouti', 'name_ar' => 'جيبوتي', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Comoros', 'name_ar' => 'جزر القمر', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
