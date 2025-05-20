<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('nationalities')->insert([
            ['name_en' => 'Algerian',        'name_ar' => 'جزائري',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Bahraini',        'name_ar' => 'بحريني',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Comorian',        'name_ar' => 'قمري',         'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Djiboutian',      'name_ar' => 'جيبوتي',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Egyptian',        'name_ar' => 'مصري',         'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Iraqi',           'name_ar' => 'عراقي',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Jordanian',       'name_ar' => 'أردني',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Kuwaiti',         'name_ar' => 'كويتي',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Lebanese',        'name_ar' => 'لبناني',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Libyan',          'name_ar' => 'ليبي',         'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Mauritanian',     'name_ar' => 'موريتاني',     'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Moroccan',        'name_ar' => 'مغربي',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Omani',           'name_ar' => 'عُماني',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Palestinian',     'name_ar' => 'فلسطيني',      'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Qatari',          'name_ar' => 'قطري',         'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Saudi Arabian',   'name_ar' => 'سعودي',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Somali',          'name_ar' => 'صومالي',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Sudanese',        'name_ar' => 'سوداني',       'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Syrian',          'name_ar' => 'سوري',         'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Tunisian',        'name_ar' => 'تونسي',        'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Emirati',         'name_ar' => 'إماراتي',      'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Yemeni',          'name_ar' => 'يمني',         'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
