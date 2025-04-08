<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    
    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'max_pixels' => 'integer',
            'company_resolutions' => 'integer',
            'email_unlocks' => 'integer',
            'has_slack_notifications' => 'boolean',
            'has_csv_exports' => 'boolean',
            'has_trial' => 'boolean',
            'trial_days' => 'integer',
            'features' => 'json',
        ];
    }
    
    /**
     * Get the subscriptions for the plan.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
    
    /**
     * Get the formatted price.
     */
    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }
    
    /**
     * Seed the default plans.
     */
    public static function seedDefaultPlans(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'price' => 99.00,
                'billing_period' => 'monthly',
                'is_active' => true,
                'is_featured' => false,
                'max_pixels' => 3,
                'company_resolutions' => 200,
                'email_unlocks' => 400,
                'has_slack_notifications' => true,
                'has_csv_exports' => true,
                'has_trial' => true,
                'trial_days' => 7,
                'features' => json_encode([
                    '3 pixels',
                    '200 company resolutions',
                    '400 email unlocks',
                    'Slack notifications',
                    'CSV exports',
                ]),
            ],
            [
                'name' => 'Growth',
                'slug' => 'growth',
                'price' => 149.00,
                'billing_period' => 'monthly',
                'is_active' => true,
                'is_featured' => true,
                'max_pixels' => 10,
                'company_resolutions' => 500,
                'email_unlocks' => 1000,
                'has_slack_notifications' => true,
                'has_csv_exports' => true,
                'has_trial' => true,
                'trial_days' => 7,
                'features' => json_encode([
                    '10 pixels',
                    '500 company resolutions',
                    '1000 email unlocks',
                    'Slack notifications',
                    'CSV exports',
                ]),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'price' => 499.00,
                'billing_period' => 'monthly',
                'is_active' => true,
                'is_featured' => false,
                'max_pixels' => 25,
                'company_resolutions' => 2000,
                'email_unlocks' => 4000,
                'has_slack_notifications' => true,
                'has_csv_exports' => true,
                'has_trial' => true,
                'trial_days' => 7,
                'features' => json_encode([
                    '25 pixels',
                    '2000 company resolutions',
                    '4000 email unlocks',
                    'Slack notifications',
                    'CSV exports',
                ]),
            ],
            [
                'name' => 'Startup Spark',
                'slug' => 'startup-spark',
                'price' => 20.00,
                'billing_period' => 'monthly',
                'is_active' => true,
                'is_featured' => false,
                'max_pixels' => 1,
                'company_resolutions' => 75,
                'email_unlocks' => 100,
                'has_slack_notifications' => true,
                'has_csv_exports' => true,
                'has_trial' => false,
                'trial_days' => 0,
                'features' => json_encode([
                    '1 pixel',
                    '75 company resolutions',
                    '100 email unlocks',
                    'CSV exports',
                    'Slack notifications',
                ]),
            ],
        ];
        
        foreach ($plans as $plan) {
            if (!self::query()->where('slug', $plan['slug'])->exists()) {
                self::query()->create($plan);
            }
        }
    }
}
