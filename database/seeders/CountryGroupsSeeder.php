<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CountryGroup;

class CountryGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name_en' => 'Egypt, Lebanon, Morocco, Iraq, Al-Hazanar, Tunisia',
                'name_ar' => 'مصر، لبنان، المغرب، العراق، الحزانر، تونس',
            ],
            [
                'name_en' => 'Jordan',
                'name_ar' => 'الأردن',
            ],
            [
                'name_en' => 'Gulf Countries, Other Countries',
                'name_ar' => 'دول الخليج وباقي دول العالم',
            ],
        ];

        foreach ($groups as $group) {
            CountryGroup::create($group); // ✅ حفظ كل مجموعة في DB
        }
    }
}
