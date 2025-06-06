<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            ['name_en' => 'Slim', 'name_ar' => 'نحيفة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Moderate', 'name_ar' => 'متوسطة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Full Figured', 'name_ar' => 'ممتلئة', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Chubby', 'name_ar' => 'ممتلئة جداً', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '55-60', 'name_ar' => '٥٥-٦٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '60-65', 'name_ar' => '٦٠-٦٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '65-70', 'name_ar' => '٦٥-٧٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '70-75', 'name_ar' => '٧٠-٧٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '75-80', 'name_ar' => '٧٥-٨٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '80-85', 'name_ar' => '٨٠-٨٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '85-90', 'name_ar' => '٨٥-٩٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '90-95', 'name_ar' => '٩٠-٩٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '95-100', 'name_ar' => '٩٥-١٠٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '100-105', 'name_ar' => '١٠٠-١٠٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '105-110', 'name_ar' => '١٠٥-١١٠', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '110-115', 'name_ar' => '١١٠-١١٥', 'created_at' => now(), 'updated_at' => now()],
            // ['name_en' => '115-120', 'name_ar' => '١١٥-١٢٠', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
