<?php

namespace App\Actions;

use App\Models\SlackIntegration;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class SetupSlackIntegrationAction
{
    /**
     * Set up a new Slack integration for the user.
     *
     * @param User $user
     * @param array $data
     * @return SlackIntegration
     */
    public function handle(User $user, array $data): SlackIntegration
    {
        // Check if user already has a Slack integration
        $slackIntegration = $user->slackIntegration;
        
        if (!$slackIntegration) {
            $slackIntegration = new SlackIntegration();
            $slackIntegration->user_id = $user->id;
        }
        
        $slackIntegration->webhook_url = $data['webhook_url'];
        $slackIntegration->channel = $data['channel'] ?? null;
        $slackIntegration->is_active = true;
        $slackIntegration->notify_on_new_lead = $data['notify_on_new_lead'] ?? true;
        $slackIntegration->notify_on_company_resolution = $data['notify_on_company_resolution'] ?? false;
        $slackIntegration->notify_on_email_unlock = $data['notify_on_email_unlock'] ?? false;
        
        // Verify the webhook URL is valid
        $this->verifyWebhookUrl($slackIntegration->webhook_url);
        
        $slackIntegration->save();
        
        // Send a test notification
        $this->sendTestNotification($slackIntegration);
        
        return $slackIntegration;
    }
    
    /**
     * Verify that the webhook URL is valid.
     *
     * @param string $webhookUrl
     * @return bool
     * @throws \Exception
     */
    private function verifyWebhookUrl(string $webhookUrl): bool
    {
        // Check if the URL is a valid Slack webhook URL
        if (!str_starts_with($webhookUrl, 'https://hooks.slack.com/services/')) {
            throw new \Exception('Invalid Slack webhook URL. It should start with https://hooks.slack.com/services/');
        }
        
        return true;
    }
    
    /**
     * Send a test notification to the Slack webhook.
     *
     * @param SlackIntegration $slackIntegration
     * @return bool
     */
    private function sendTestNotification(SlackIntegration $slackIntegration): bool
    {
        $blocks = [
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => '🎉 Slack Integration Setup Successfully!',
                    'emoji' => true
                ]
            ],
            [
                'type' => 'section',
                'text' => [
                    'type' => 'mrkdwn',
                    'text' => "Your Slack integration has been set up successfully. You will now receive notifications when new leads are captured by your pixels."
                ]
            ],
            [
                'type' => 'context',
                'elements' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "From the Lead Pixel application"
                    ]
                ]
            ]
        ];
        
        return $slackIntegration->sendNotification('Slack Integration Setup Successfully', $blocks);
    }
} 