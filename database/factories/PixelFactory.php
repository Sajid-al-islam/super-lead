<?php

namespace Database\Factories;

use App\Models\Pixel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pixel>
 */
class PixelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(3, true),
            'domain' => fake()->domainName(),
            'pixel_id' => Pixel::generatePixelId(),
            'pixel_code' => Pixel::generatePixelCode(),
            'is_active' => true,
            'is_verified' => fake()->boolean(80),
            'last_activity' => fake()->dateTimeBetween('-30 days', 'now'),
            'visitor_count' => fake()->numberBetween(0, 1000),
            'lead_count' => fake()->numberBetween(0, 100),
            'created_at' => fake()->dateTimeBetween('-60 days', '-30 days'),
            'updated_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
} 