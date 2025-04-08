<?php

namespace Tests\Unit\Actions;

use App\Actions\CreatePixelAction;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePixelActionTest extends TestCase
{
    use RefreshDatabase;
    
    protected User $user;
    protected Plan $plan;
    protected Subscription $subscription;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a plan
        $this->plan = Plan::query()->create([
            'name' => 'Test Plan',
            'slug' => 'test-plan',
            'price' => 99.00,
            'billing_period' => 'monthly',
            'is_active' => true,
            'max_pixels' => 3,
            'company_resolutions' => 100,
            'email_unlocks' => 200,
        ]);
        
        // Create a user
        $this->user = User::factory()->create();
        
        // Create a subscription
        $this->subscription = new Subscription();
        $this->subscription->user_id = $this->user->id;
        $this->subscription->plan_id = $this->plan->id;
        $this->subscription->starts_at = now();
        $this->subscription->ends_at = now()->addMonth();
        $this->subscription->is_active = true;
        $this->subscription->status = 'active';
        $this->subscription->save();
    }
    
    /** @test */
    public function it_creates_a_pixel_for_the_user(): void
    {
        $action = new CreatePixelAction();
        
        $pixel = $action->handle($this->user, [
            'name' => 'Test Pixel',
            'domain' => 'https://example.com',
        ]);
        
        $this->assertDatabaseHas('pixels', [
            'user_id' => $this->user->id,
            'name' => 'Test Pixel',
            'domain' => 'example.com',
            'is_active' => true,
            'is_verified' => false,
        ]);
        
        $this->assertNotNull($pixel->pixel_id);
        $this->assertNotNull($pixel->pixel_code);
    }
    
    /** @test */
    public function it_throws_exception_if_user_has_no_active_subscription(): void
    {
        // Delete the subscription
        $this->subscription->delete();
        
        $action = new CreatePixelAction();
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('You do not have an active subscription.');
        
        $action->handle($this->user, [
            'name' => 'Test Pixel',
            'domain' => 'https://example.com',
        ]);
    }
    
    /** @test */
    public function it_throws_exception_if_user_reaches_pixel_limit(): void
    {
        $action = new CreatePixelAction();
        
        // Create max number of pixels
        for ($i = 0; $i < $this->plan->max_pixels; $i++) {
            $action->handle($this->user, [
                'name' => "Test Pixel {$i}",
                'domain' => "https://example{$i}.com",
            ]);
        }
        
        // Try to create one more
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("You have reached your limit of {$this->plan->max_pixels} pixels. Please upgrade your plan to add more pixels.");
        
        $action->handle($this->user, [
            'name' => 'One Too Many',
            'domain' => 'https://toomany.com',
        ]);
    }
    
    /** @test */
    public function it_normalizes_domain_correctly(): void
    {
        $action = new CreatePixelAction();
        
        $pixel = $action->handle($this->user, [
            'name' => 'Test Pixel',
            'domain' => 'https://www.example.com/some/path/',
        ]);
        
        $this->assertEquals('example.com', $pixel->domain);
    }
} 