<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
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
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_active' => 'boolean',
            'is_trial' => 'boolean',
            'amount_paid' => 'decimal:2',
            'company_resolutions_used' => 'integer',
            'email_unlocks_used' => 'integer',
        ];
    }

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the plan for the subscription.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Check if the subscription is active.
     */
    public function isActive(): bool
    {
        return $this->is_active && now()->lt($this->ends_at);
    }

    /**
     * Check if the subscription is on trial.
     */
    public function onTrial(): bool
    {
        return $this->is_trial && now()->lt($this->ends_at);
    }

    /**
     * Check if the subscription has expired.
     */
    public function hasExpired(): bool
    {
        return now()->gte($this->ends_at);
    }

    /**
     * Get the company resolutions remaining.
     */
    public function companyResolutionsRemaining(): int
    {
        return max(0, $this->plan->company_resolutions - $this->company_resolutions_used);
    }

    /**
     * Get the email unlocks remaining.
     */
    public function emailUnlocksRemaining(): int
    {
        return max(0, $this->plan->email_unlocks - $this->email_unlocks_used);
    }

    /**
     * Check if the subscription has been cancelled.
     */
    public function cancelled(): bool
    {
        return !$this->is_active && $this->ends_at !== null;
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(): bool
    {
        $this->is_active = false;
        if (!$this->ends_at) {
            $this->ends_at = now()->endOfMonth();
        }
        return $this->save();
    }
}
