<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarriageBudgetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('marriage_budgets')->insert([
            ['budget' => '5000-10000', 'currency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['budget' => '10000-20000', 'currency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['budget' => '20000-30000', 'currency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['budget' => '30000+', 'currency_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}