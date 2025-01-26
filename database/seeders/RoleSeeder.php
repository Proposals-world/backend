<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name_en' => 'Admin',
                'name_ar' => 'مدير',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_en' => 'User',
                'name_ar' => 'مستخدم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}