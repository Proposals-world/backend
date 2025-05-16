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
            ['name_en' => 'Black',  'name_ar' => 'أسود'],
            ['name_en' => 'Brown',  'name_ar' => 'بني'],
            ['name_en' => 'Hazel',  'name_ar' => 'بني عسلي'],
            ['name_en' => 'Green',  'name_ar' => 'أخضر'],
            ['name_en' => 'Blue',   'name_ar' => 'أزرق'],
            ['name_en' => 'Grey',   'name_ar' => 'رمادي'],
        ];

        foreach ($eyeColors as $eyeColor) {
            EyeColor::create($eyeColor);
        }
    }
}
