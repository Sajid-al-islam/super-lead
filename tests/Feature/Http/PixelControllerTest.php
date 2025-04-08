<?php

namespace Tests\Feature\Http;

use App\Models\Pixel;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PixelControllerTest extends TestCase
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
    public function it_shows_pixels_index_page(): void
    {
        $pixel = Pixel::query()->create([
            'user_id' => $this->user->id,
            'name' => 'Test Pixel',
            'domain' => 'example.com',
            'pixel_id' => 'PIX_TEST123',
            'pixel_code' => 'test123code',
            'is_active' => true,
        ]);
        
        $this->actingAs($this->user)
            ->get(route('pixels.index'))
            ->assertStatus(200)
            ->assertSee('Test Pixel')
            ->assertSee('example.com');
    }
    
    /** @test */
    public function it_creates_a_new_pixel(): void
    {
        $this->actingAs($this->user)
            ->post(route('pixels.store'), [
                'name' => 'New Pixel',
                'domain' => 'https://newdomain.com',
            ])
            ->assertRedirect()
            ->assertSessionHas('success');
            
        $this->assertDatabaseHas('pixels', [
            'user_id' => $this->user->id,
            'name' => 'New Pixel',
            'domain' => 'newdomain.com',
        ]);
    }
    
    /** @test */
    public function it_shows_pixel_code(): void
    {
        $pixel = Pixel::query()->create([
            'user_id' => $this->user->id,
            'name' => 'Test Pixel',
            'domain' => 'example.com',
            'pixel_id' => 'PIX_TEST123',
            'pixel_code' => 'test123code',
            'is_active' => true,
        ]);
        
        $this->actingAs($this->user)
            ->get(route('pixels.code', $pixel))
            ->assertStatus(200)
            ->assertSee('Test Pixel')
            ->assertSee('test123code');
    }
    
    /** @test */
    public function it_prevents_access_to_pixels_from_other_users(): void
    {
        $otherUser = User::factory()->create();
        
        $pixel = Pixel::query()->create([
            'user_id' => $otherUser->id,
            'name' => 'Other User Pixel',
            'domain' => 'example.com',
            'pixel_id' => 'PIX_TEST123',
            'pixel_code' => 'test123code',
            'is_active' => true,
        ]);
        
        $this->actingAs($this->user)
            ->get(route('pixels.show', $pixel))
            ->assertStatus(403);
    }
    
    /** @test */
    public function it_handles_pixel_tracking_request(): void
    {
        $pixel = Pixel::query()->create([
            'user_id' => $this->user->id,
            'name' => 'Test Pixel',
            'domain' => 'example.com',
            'pixel_id' => 'PIX_TEST123',
            'pixel_code' => 'test123code',
            'is_active' => true,
        ]);
        
        $this->get(route('pixels.track', $pixel->pixel_code))
            ->assertStatus(200)
            ->assertJson(['success' => true]);
            
        $this->assertDatabaseHas('visitor_data', [
            'pixel_id' => $pixel->id,
        ]);
        
        // Refresh the pixel
        $pixel->refresh();
        
        // Check that the visitor count was incremented
        $this->assertEquals(1, $pixel->visitor_count);
    }
} 