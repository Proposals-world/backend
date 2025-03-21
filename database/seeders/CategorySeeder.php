<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name_ar' => 'تكنولوجيا', 'name_en' => 'Technology'],
            ['name_ar' => 'صحة', 'name_en' => 'Health'],
            ['name_ar' => 'رياضة', 'name_en' => 'Sports'],
            ['name_ar' => 'أعمال', 'name_en' => 'Business'],
            ['name_ar' => 'سفر', 'name_en' => 'Travel'],
            ['name_ar' => 'فن', 'name_en' => 'Art'],
            ['name_ar' => 'ترفيه', 'name_en' => 'Entertainment'],
            ['name_ar' => 'علوم', 'name_en' => 'Science'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name_ar' => $category['name_ar'],
                'name_en' => $category['name_en'],
                'slug' => Str::slug($category['name_en']), // Generates a URL-friendly slug
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
