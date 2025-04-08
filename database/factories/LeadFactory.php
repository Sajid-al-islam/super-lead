<?php

namespace Database\Factories;

use App\Models\Pixel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pixel_id' => Pixel::factory(),
            'user_id' => function (array $attributes) {
                return Pixel::find($attributes['pixel_id'])->user_id;
            },
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'company' => fake()->company(),
            'job_title' => fake()->jobTitle(),
            'linkedin_url' => 'https://linkedin.com/in/' . fake()->userName(),
            'linkedin_connections' => fake()->numberBetween(50, 2000),
            'linkedin_joined_date' => fake()->dateTimeBetween('-5 years', '-1 year'),
            'linkedin_last_active_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'twitter_url' => 'https://twitter.com/' . fake()->userName(),
            'twitter_connections' => fake()->numberBetween(10, 5000),
            'twitter_joined_date' => fake()->dateTimeBetween('-8 years', '-1 year'),
            'twitter_last_active_date' => fake()->dateTimeBetween('-2 months', 'now'),
            'instagram_url' => 'https://instagram.com/' . fake()->userName(),
            'instagram_connections' => fake()->numberBetween(50, 10000),
            'instagram_joined_date' => fake()->dateTimeBetween('-7 years', '-1 year'),
            'instagram_last_active_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'is_notified' => fake()->boolean(70),
            'is_exported' => fake()->boolean(30),
            'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'updated_at' => fake()->dateTimeBetween('-7 days', 'now'),
        ];
    }
} 