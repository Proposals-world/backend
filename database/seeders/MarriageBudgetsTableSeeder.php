<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarriageBudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marriage_budgets')->insert([
            [
                'budget_en'    => 'No Preference',
                'budget_ar'    => 'لا تفضيل',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'budget_en'    => 'Very Simple (Less than 5000 dinars)',
                'budget_ar'    => 'بسيطة جدا أقل من 5 الاف دينار',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'budget_en'    => 'Simple (5000 dinars)',
                'budget_ar'    => 'بسيطة 5 الاف دينار',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'budget_en'    => 'Good (10000 dinars)',
                'budget_ar'    => 'جيدة 10 الاف دينار',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'budget_en'    => 'Very Good',
                'budget_ar'    => 'جيدة جدا',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'budget_en'    => 'Excellent',
                'budget_ar'    => 'ممتازة',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}