<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Pixel;
use App\Models\SlackIntegration;
use App\Models\Subscription;
use App\Models\User;
use App\Models\VisitorData;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed plans
        $this->call([
            PlanSeeder::class,
        ]);
        
        // Create admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        
        // Create test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        // Create 10 regular users
        User::factory(10)->create();
        
        // For each user, create subscriptions, pixels, and slack integrations
        User::all()->each(function ($user) {
            // 80% chance of having an active subscription
            if (fake()->boolean(80)) {
                Subscription::factory()->active()->create([
                    'user_id' => $user->id,
                ]);
            }
            
            // Create 1-5 pixels per user
            $pixelCount = fake()->numberBetween(1, 5);
            $pixels = Pixel::factory($pixelCount)->create([
                'user_id' => $user->id,
            ]);
            
            // For each pixel, create 1-10 leads
            $pixels->each(function ($pixel) {
                $leadCount = fake()->numberBetween(1, 10);
                $leads = Lead::factory($leadCount)->create([
                    'pixel_id' => $pixel->id,
                    'user_id' => $pixel->user_id,
                ]);
                
                // For each lead, create 1-5 visitor data records
                $leads->each(function ($lead) {
                    VisitorData::factory(fake()->numberBetween(1, 5))->create([
                        'pixel_id' => $lead->pixel_id,
                        'lead_id' => $lead->id,
                    ]);
                });
                
                // Update pixel lead count
                $pixel->update([
                    'lead_count' => $pixel->leads()->count(),
                    'visitor_count' => $pixel->visitorData()->count(),
                ]);
            });
            
            // 50% chance of having a slack integration
            if (fake()->boolean(50)) {
                SlackIntegration::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
        
        // Create more data for the test user
        Pixel::factory(3)->create([
            'user_id' => $testUser->id,
        ]);
        
        // Create a subscription for the test user
        Subscription::factory()->active()->create([
            'user_id' => $testUser->id,
        ]);
        
        // Create a bunch of leads and visitor data for one of the test user's pixels
        $testPixel = $testUser->pixels()->first();
        if ($testPixel) {
            $leads = Lead::factory(20)->create([
                'pixel_id' => $testPixel->id,
                'user_id' => $testUser->id,
            ]);
            
            $leads->each(function ($lead) {
                VisitorData::factory(fake()->numberBetween(2, 8))->create([
                    'pixel_id' => $lead->pixel_id,
                    'lead_id' => $lead->id,
                ]);
            });
            
            // Update test pixel lead count
            $testPixel->update([
                'lead_count' => $testPixel->leads()->count(),
                'visitor_count' => $testPixel->visitorData()->count(),
            ]);
        }
    }
}
