<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition(): array
    {
        return [
            'id' => User::inRandomOrder()->first()->id ?? User::factory(), // Randomly associate with an existing user or create a new one
            'city_location_id' => null,
            'bio_en' => $this->faker->paragraph,
            'bio_ar' => $this->faker->paragraph,
            'avatar_url' => $this->faker->imageUrl(),
            'id_number' => $this->faker->randomNumber(),
            'language_id' => null, // Based on available languages
            'criminal_record_url' => $this->faker->url,
            'id_verification_status' => $this->faker->randomElement(['verified', 'unverified']),
            'criminal_record_status' => $this->faker->randomElement(['verified', 'unverified']),
            'nationality_id' => 1, // Based on the available nationalities
            'origin_id' => rand(1, 2), // Based on the available origins
            'religion_id' => rand(1, 2), // Based on the available religions
            'country_of_residence_id' => rand(1, 5), // Based on available countries
            'city_id' => rand(1, 5), // Based on available cities
            'date_of_birth' => $this->faker->date(),
            'age' => $this->faker->numberBetween(18, 65),
            'zodiac_sign_id' => rand(1, 12), // Based on available zodiac signs
            'educational_level_id' => rand(1, 4), // Based on educational levels
            'specialization_id' => rand(1, 4), // Based on available specializations
            'employment_status' => $this->faker->boolean(),
            'job_title_id' => rand(1, 5), // Based on available job titles
            'sector_id' => rand(1, 4), // Based on available sectors
            'position_level_id' => rand(1, 4), // Based on available position levels
            'financial_status_id' => rand(1, 4), // Based on financial statuses
            'housing_id' => rand(1, 4), // Based on available housing statuses
            'car_ownership' => $this->faker->boolean(),
            'height_id' => rand(1, 3), // Based on available heights
            'weight_id' => rand(1, 5), // Based on available weights
            'health_issues_en' => $this->faker->text(),
            'health_issues_ar' => $this->faker->text(),
            'marital_status_id' => rand(1, 4), // Based on available marital statuses
            'children' => $this->faker->numberBetween(0, 5),
            'skin_color_id' => rand(1, 3), // Based on available skin colors
            'hair_color_id' => rand(1, 4), // Based on available hair colors
            'hijab_status' => $this->faker->randomElement([0, 1]),
            'smoking_status' => $this->faker->randomElement([0, 1]),
            'drinking_status_id' => rand(1, 3), // Based on available drinking statuses
            'sports_activity_id' => rand(1, 4), // Based on available sports activities
            'social_media_presence_id' => rand(1, 4), // Based on available social media presences
            'guardian_contact_encrypted' => $this->faker->word(),
            'religiosity_level_id' => rand(1, 5), // Based on available religiosity levels
            'sleep_habit_id' => rand(1, 3), // Based on available sleep habits
            'marriage_budget_id' => rand(1, 5), // Based on available marriage budgets
            'eye_color_id' => rand(1, 20), // Based on available eye colors
        ];
    }
}
