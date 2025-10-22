<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusesAdditionalSeeder extends Seeder
{
    public function run()
    {
        DB::table('marital_statuses')->insert([
            ['name_en' => 'Divorced without children', 'name_ar' => 'مطلق بدون أولاد', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Divorced with child / children', 'name_ar' => 'مطلق لي طفل / أطفال', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Divorced with child / children & don’t want more', 'name_ar' => 'مطلق لي طفل / أطفال ولا أرغب بالمزيد', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Widowed without children', 'name_ar' => 'أرمل بدون أطفال', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Widowed with child / children', 'name_ar' => 'أرمل ولي طفل / أطفال', 'created_at' => now(), 'updated_at' => now()],
            ['name_en' => 'Widowed with child / children & don’t want more', 'name_ar' => 'أرمل ولي طفل / أطفال ولا أرغب بالمزيد', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
