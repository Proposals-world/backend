<?php

namespace Database\Factories;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->numerify('##########'), // 10-digit phone number
            'password' => "testuser",
            'profile_status' => fake()->randomElement(['active', 'inactive', 'pending']), // Example profile statuses
            'created_at' => fake()->dateTimeThisYear(), // Random created_at within this year
            'updated_at' => fake()->dateTimeThisYear(), // Random updated_at within this year
            'last_active' => fake()->dateTimeThisMonth(), // Random last_active within this month
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']), // Example status values
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
