<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Pixel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisitorData>
 */
class VisitorDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Safari/605.1.15',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (iPad; CPU OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 11; SM-G996B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.120 Mobile Safari/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:89.0) Gecko/20100101 Firefox/89.0',
        ];

        return [
            'pixel_id' => Pixel::factory(),
            'lead_id' => Lead::factory(),
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->randomElement($userAgents),
            'referrer' => fake()->url(),
            'page_url' => fake()->url(),
            'country' => fake()->country(),
            'city' => fake()->city(),
            'device_type' => fake()->randomElement(['desktop', 'mobile', 'tablet']),
            'browser' => fake()->randomElement(['Chrome', 'Safari', 'Firefox', 'Edge']),
            'operating_system' => fake()->randomElement(['Windows', 'macOS', 'iOS', 'Android', 'Linux']),
            'is_processed' => fake()->boolean(90),
            'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'updated_at' => fake()->dateTimeBetween('-7 days', 'now'),
        ];
    }
} 