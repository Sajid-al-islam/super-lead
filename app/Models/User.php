<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Get all pixels for the user.
     */
    public function pixels(): HasMany
    {
        return $this->hasMany(Pixel::class);
    }
    
    /**
     * Get all leads for the user.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
    
    /**
     * Get all subscriptions for the user.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
    
    /**
     * Get active subscription for the user.
     */
    public function activeSubscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('is_active', true)
            ->whereDate('ends_at', '>=', now())
            ->latest();
    }
    
    /**
     * Get the slack integration for the user.
     */
    public function slackIntegration(): HasOne
    {
        return $this->hasOne(SlackIntegration::class);
    }
}
