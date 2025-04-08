<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startsAt = fake()->dateTimeBetween('-6 months', 'now');
        $isActive = fake()->boolean(80);
        
        return [
            'user_id' => User::factory(),
            'plan_id' => Plan::query()->inRandomOrder()->first()->id ?? 1,
            'starts_at' => $startsAt,
            'ends_at' => fake()->dateTimeBetween($startsAt, '+1 year'),
            'is_active' => $isActive,
            'is_trial' => fake()->boolean(30),
            'amount_paid' => fake()->randomFloat(2, 20, 500),
            'company_resolutions_used' => fake()->numberBetween(0, 200),
            'email_unlocks_used' => fake()->numberBetween(0, 400),
            'created_at' => $startsAt,
            'updated_at' => fake()->dateTimeBetween($startsAt, 'now'),
        ];
    }
    
    /**
     * Indicate that the subscription is active.
     */
    public function active(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
                'ends_at' => fake()->dateTimeBetween('now', '+1 year'),
            ];
        });
    }
    
    /**
     * Indicate that the subscription is a trial.
     */
    public function trial(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_trial' => true,
                'starts_at' => now(),
                'ends_at' => now()->addDays(7),
            ];
        });
    }
} 