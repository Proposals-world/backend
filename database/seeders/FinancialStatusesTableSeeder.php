<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('financial_statuses')->insert([
            ['name_en' => 'Stable', 'name_ar' => 'مستقر', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Needs Improvement', 'name_ar' => 'يحتاج لتحسين', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Excellent', 'name_ar' => 'ممتاز', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Poor', 'name_ar' => 'فقير', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}