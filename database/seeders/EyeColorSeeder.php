<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EyeColor;

class EyeColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eyeColors = [
            ['name_en' => 'Blue',           'name_ar' => 'أزرق'],
            ['name_en' => 'Green',          'name_ar' => 'أخضر'],
            ['name_en' => 'Brown',          'name_ar' => 'بني'],
            ['name_en' => 'Hazel',          'name_ar' => 'بني عسلي'],
            ['name_en' => 'Gray',           'name_ar' => 'رمادي'],
            ['name_en' => 'Amber',          'name_ar' => 'كهرماني'],
            ['name_en' => 'Red',            'name_ar' => 'أحمر'],
            ['name_en' => 'Violet',         'name_ar' => 'بنفسجي'],
            ['name_en' => 'Black',          'name_ar' => 'أسود'],
            ['name_en' => 'Light Brown',    'name_ar' => 'بني فاتح'],
            ['name_en' => 'Dark Brown',     'name_ar' => 'بني داكن'],
            ['name_en' => 'Steel Blue',     'name_ar' => 'أزرق فولاذي'],
            ['name_en' => 'Ice Blue',       'name_ar' => 'أزرق ثلجي'],
            ['name_en' => 'Turquoise',      'name_ar' => 'فيروزي'],
            ['name_en' => 'Emerald',        'name_ar' => 'زمردي'],
            ['name_en' => 'Aquamarine',     'name_ar' => 'أكوامارين'],
            ['name_en' => 'Sapphire',       'name_ar' => 'ياقوتي'],
            ['name_en' => 'Topaz',          'name_ar' => 'توباز'],
            ['name_en' => 'Golden',         'name_ar' => 'ذهبي'],
            ['name_en' => 'Multicolored',   'name_ar' => 'متعدد الألوان'],
        ];

        foreach ($eyeColors as $eyeColor) {
            EyeColor::create($eyeColor);
        }
    }
}