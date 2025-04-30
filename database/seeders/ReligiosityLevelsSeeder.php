<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligiosityLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Religiosity levels for males (gender = 1)
        $maleLevels = [
            [
                'gender'     => 1,
                'name_en'    => 'Very Devout',
                'name_ar'    => 'ملتزم جدا',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 1,
                'name_en'    => 'Devout',
                'name_ar'    => 'ملتزم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 1,
                'name_en'    => 'Moderately Devout',
                'name_ar'    => 'معتل',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 1,
                'name_en'    => 'Average',
                'name_ar'    => 'متوسط',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 1,
                'name_en'    => 'Low',
                'name_ar'    => 'قليل',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Religiosity levels for females (gender = 2)
        $femaleLevels = [
            [
                'gender'     => 2,
                'name_en'    => 'Very Covered',
                'name_ar'    => 'مجلببة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Strictly Hijab',
                'name_ar'    => 'محجبة ملتزمة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Hijab',
                'name_ar'    => 'محجبة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Modestly Non-Hijab',
                'name_ar'    => 'غير محجبة ملتزمة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Non-Hijab',
                'name_ar'    => 'غيرمحجبة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Open',
                'name_ar'    => 'منفتح',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Average',
                'name_ar'    => 'متوسط',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Committed',
                'name_ar'    => 'ملتزم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gender'     => 2,
                'name_en'    => 'Devout',
                'name_ar'    => 'متددين',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        // Merge both arrays and insert into the table.
        DB::table('religiosity_levels')->insert(array_merge($maleLevels, $femaleLevels));
    }
}
