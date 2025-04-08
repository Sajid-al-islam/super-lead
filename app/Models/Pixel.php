<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pixel extends Model
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
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'last_activity' => 'datetime',
            'visitor_count' => 'integer',
            'lead_count' => 'integer',
        ];
    }
    
    /**
     * Get the user that owns the pixel.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the visitor data for the pixel.
     */
    public function visitorData(): HasMany
    {
        return $this->hasMany(VisitorData::class);
    }
    
    /**
     * Get the leads for the pixel.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
    
    /**
     * Generate a unique pixel code for the user's domain.
     */
    public static function generatePixelCode(): string
    {
        return bin2hex(random_bytes(16));
    }
    
    /**
     * Generate a unique pixel ID.
     */
    public static function generatePixelId(): string
    {
        return 'PIX_' . strtoupper(bin2hex(random_bytes(8)));
    }
}
