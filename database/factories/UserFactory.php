<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->optional()->phoneNumber,
            'password' => Hash::make('password123'), // Default password
            'profile_status' => 'active',
            'gender' => $this->faker->randomElement(['male', 'female']),
            'otp' => null,
            'otp_expires_at' => null,
            'last_active' => now(),
            'role_id' => rand(1, 2), // Adjust based on available roles
            'status' => 'active',
            'fcm_token' => Str::random(32),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
