<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SlackIntegration>
 */
class SlackIntegrationFactory extends Factory
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
            'webhook_url' => 'https://hooks.slack.com/services/' . fake()->regexify('[A-Z0-9]{9}/[A-Z0-9]{9}/[a-zA-Z0-9]{24}'),
            'channel' => '#' . fake()->word(),
            'is_active' => fake()->boolean(80),
            'notify_on_new_lead' => fake()->boolean(90),
            'notify_on_company_resolution' => fake()->boolean(70),
            'notify_on_email_unlock' => fake()->boolean(60),
            'last_notification_at' => fake()->optional(70)->dateTimeBetween('-30 days', 'now'),
            'created_at' => fake()->dateTimeBetween('-3 months', '-1 month'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
} 