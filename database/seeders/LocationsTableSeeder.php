<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('locations')->insert([
            [
                'city_id' => 1, // Amman
                'country_id' => 1, // Jordan
                'latitude' => 31.9539,
                'longitude' => 35.9106,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_id' => 2, // Cairo
                'country_id' => 2, // Egypt
                'latitude' => 30.0444,
                'longitude' => 31.2357,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_id' => 3, // Beirut
                'country_id' => 3, // Lebanon
                'latitude' => 33.8938,
                'longitude' => 35.5018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_id' => 4, // Damascus
                'country_id' => 4, // Syria
                'latitude' => 33.5138,
                'longitude' => 36.2765,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_id' => 5, // Ramallah
                'country_id' => 5, // Palestine
                'latitude' => 32.1848,
                'longitude' => 35.3018,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city_id' => 6, // Zarqa
                'country_id' => 1, // Jordan
                'latitude' => 32.0732,
                'longitude' => 35.8063,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more locations as needed
        ]);
    }
}