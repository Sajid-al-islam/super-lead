<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Http;

class SlackIntegration extends Model
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
            'notify_on_new_lead' => 'boolean',
            'notify_on_company_resolution' => 'boolean',
            'notify_on_email_unlock' => 'boolean',
            'last_notification_at' => 'datetime',
        ];
    }
    
    /**
     * Get the user that owns the slack integration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Send a notification to Slack.
     */
    public function sendNotification(string $message, array $blocks = []): bool
    {
        if (!$this->is_active || empty($this->webhook_url)) {
            return false;
        }
        
        $payload = [
            'text' => $message,
        ];
        
        if (!empty($blocks)) {
            $payload['blocks'] = $blocks;
        }
        
        $response = Http::post($this->webhook_url, $payload);
        
        if ($response->successful()) {
            $this->last_notification_at = now();
            $this->save();
            return true;
        }
        
        return false;
    }
    
    /**
     * Create lead notification for Slack.
     */
    public function createLeadNotification(Lead $lead): array
    {
        $blocks = [
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => '🎯 New Lead Captured!',
                    'emoji' => true
                ]
            ],
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Name:*\n" . ($lead->name ?? 'Unknown')
                    ],
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Company:*\n" . ($lead->company ?? 'Unknown')
                    ]
                ]
            ],
            [
                'type' => 'section',
                'fields' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Email:*\n" . ($lead->email ?? 'Not available')
                    ],
                    [
                        'type' => 'mrkdwn',
                        'text' => "*Job Title:*\n" . ($lead->job_title ?? 'Unknown')
                    ]
                ]
            ],
            [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "*Insights:*\n" . ($lead->insights ?? $lead->generateInsights())
                ]
            ],
            [
                'type' => 'divider'
            ],
            [
                'type' => 'context',
                'elements' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "Captured via pixel: " . $lead->pixel->name
                    ]
                ]
            ]
        ];
        
        return $blocks;
    }
}
