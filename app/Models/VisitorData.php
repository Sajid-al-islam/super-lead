<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorData extends Model
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
            'is_processed' => 'boolean',
        ];
    }
    
    /**
     * Get the pixel that the visitor data belongs to.
     */
    public function pixel(): BelongsTo
    {
        return $this->belongsTo(Pixel::class);
    }
    
    /**
     * Get the lead that the visitor data belongs to.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
    
    /**
     * Parse user agent to extract browser, device, and operating system.
     */
    public function parseUserAgent(?string $userAgent = null): array
    {
        $userAgent = $userAgent ?? $this->user_agent;
        
        // Simple parsing logic for demonstration
        $browser = preg_match('/(Chrome|Safari|Firefox|Edge|MSIE|Opera)/i', $userAgent, $matches) ? $matches[1] : 'Unknown';
        $device = preg_match('/(Mobile|Android|iPhone|iPad|Windows Phone)/i', $userAgent, $matches) ? 'Mobile' : 'Desktop';
        $os = 'Unknown';
        
        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Macintosh|Mac OS X/i', $userAgent)) {
            $os = 'macOS';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $os = 'Linux';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
            $os = 'iOS';
        }
        
        return [
            'browser' => $browser,
            'device' => $device,
            'operating_system' => $os,
        ];
    }
}
