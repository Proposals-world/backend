<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SmokingTool;

class SmokingToolsSeeder extends Seeder
{
    public function run(): void
    {
        $tools = [
            ['name_en' => 'Cigarette', 'name_ar' => 'سيجارة'],
            ['name_en' => 'Hookah', 'name_ar' => 'شيشة'],
            ['name_en' => 'Vape', 'name_ar' => 'فيب'],
        ];

        foreach ($tools as $tool) {
            SmokingTool::create($tool);
        }
    }
}
