<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialStatusesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('financial_statuses')->insert([
            ['name_en' => 'Very Modest', 'name_ar' => 'متواضع جدا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Modest', 'name_ar' => 'متواضع', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Average', 'name_ar' => 'متوسط', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Very Good', 'name_ar' => 'جيد جدا', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Advanced', 'name_ar' => 'متقدم', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
