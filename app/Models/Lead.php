<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
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
            'linkedin_connections' => 'integer',
            'linkedin_joined_date' => 'date',
            'linkedin_last_active_date' => 'date',
            'twitter_connections' => 'integer',
            'twitter_joined_date' => 'date',
            'twitter_last_active_date' => 'date',
            'instagram_connections' => 'integer',
            'instagram_joined_date' => 'date',
            'instagram_last_active_date' => 'date',
            'is_notified' => 'boolean',
            'is_exported' => 'boolean',
        ];
    }
    
    /**
     * Get the pixel that the lead belongs to.
     */
    public function pixel(): BelongsTo
    {
        return $this->belongsTo(Pixel::class);
    }
    
    /**
     * Get the user that owns the lead.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the visitor data associated with this lead.
     */
    public function visitorData(): HasMany
    {
        return $this->hasMany(VisitorData::class);
    }
    
    /**
     * Generate insights for the lead.
     */
    public function generateInsights(): string
    {
        $company = $this->company ?? 'Unknown';
        $name = $this->name ?? 'This lead';
        $jobTitle = $this->job_title ?? 'professional';
        
        return "{$name} specializes in " . ($this->job_title ? $jobTitle . " at {$company}." : "working at {$company}.") . 
               " Engaging with them could provide your team with valuable insights and potential business opportunities.";
    }
}
