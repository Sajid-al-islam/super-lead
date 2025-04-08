<?php

namespace App\Actions;

use App\Models\Lead;
use App\Models\Pixel;
use App\Models\User;
use App\Models\VisitorData;
use Exception;
use Illuminate\Support\Facades\Log;

class ProcessVisitorDataAction
{
    /**
     * Process visitor data to extract lead information.
     *
     * @param VisitorData $visitorData
     * @return Lead|null
     */
    public function handle(VisitorData $visitorData): ?Lead
    {
        try {
            if ($visitorData->is_processed) {
                return $visitorData->lead;
            }
            
            $pixel = $visitorData->pixel;
            $user = $pixel->user;
            
            // Parse user agent data
            $userAgentData = $visitorData->parseUserAgent();
            $visitorData->browser = $userAgentData['browser'];
            $visitorData->device = $userAgentData['device'];
            $visitorData->operating_system = $userAgentData['operating_system'];
            
            // Attempt to resolve company information from IP
            $companyData = $this->resolveCompanyFromIp($visitorData->ip_address, $user);
            
            if ($companyData) {
                $visitorData->company_name = $companyData['name'] ?? null;
                $visitorData->company_domain = $companyData['domain'] ?? null;
                $visitorData->company_ip = $visitorData->ip_address;
                
                // Create or update lead
                $lead = $this->createOrUpdateLead($visitorData, $companyData, $user, $pixel);
                $visitorData->lead_id = $lead->id;
                $visitorData->is_processed = true;
                $visitorData->save();
                
                // Increment the lead count on the pixel
                $pixel->increment('lead_count');
                
                // Send Slack notification if configured
                $this->sendSlackNotification($lead, $user);
                
                return $lead;
            }
            
            // Mark as processed even if no company data was found
            $visitorData->is_processed = true;
            $visitorData->save();
            
            return null;
        } catch (Exception $e) {
            Log::error('Error processing visitor data: ' . $e->getMessage(), [
                'visitor_data_id' => $visitorData->id,
                'exception' => $e,
            ]);
            
            return null;
        }
    }
    
    /**
     * Resolve company information from IP address.
     *
     * @param string|null $ipAddress
     * @param User $user
     * @return array|null
     */
    private function resolveCompanyFromIp(?string $ipAddress, User $user): ?array
    {
        if (!$ipAddress) {
            return null;
        }
        
        $subscription = $user->activeSubscription;
        
        if (!$subscription) {
            return null;
        }
        
        // Check if user has remaining company resolutions
        if ($subscription->companyResolutionsRemaining() <= 0) {
            return null;
        }
        
        // Increment the company resolutions used
        $subscription->increment('company_resolutions_used');
        
        // For demo purposes, we'll generate a fake company
        // In a real app, this would call an external API to resolve company info
        $companies = [
            ['name' => 'Acme Corporation', 'domain' => 'acme.com'],
            ['name' => 'Globex Corporation', 'domain' => 'globex.com'],
            ['name' => 'Initech', 'domain' => 'initech.com'],
            ['name' => 'Massive Dynamic', 'domain' => 'massivedynamic.com'],
            ['name' => 'Umbrella Corporation', 'domain' => 'umbrella.com'],
        ];
        
        return $companies[array_rand($companies)];
    }
    
    /**
     * Create or update a lead based on visitor data.
     *
     * @param VisitorData $visitorData
     * @param array $companyData
     * @param User $user
     * @param Pixel $pixel
     * @return Lead
     */
    private function createOrUpdateLead(VisitorData $visitorData, array $companyData, User $user, Pixel $pixel): Lead
    {
        // Check if we already have a lead with this company for this pixel
        $lead = Lead::query()
            ->where('pixel_id', $pixel->id)
            ->where('company', $companyData['name'])
            ->first();
        
        if (!$lead) {
            $lead = new Lead();
            $lead->pixel_id = $pixel->id;
            $lead->user_id = $user->id;
            $lead->company = $companyData['name'];
        }
        
        // For demo purposes, we'll generate sample data
        // In a real app, we would enrich this data from external sources
        if (!$lead->name) {
            // Only enrich if user has email unlocks remaining
            $subscription = $user->activeSubscription;
            if ($subscription && $subscription->emailUnlocksRemaining() > 0) {
                $firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Lisa', 'Robert', 'Emily'];
                $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia'];
                
                $lead->name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
                $lead->email = strtolower(str_replace(' ', '.', $lead->name)) . '@' . $companyData['domain'];
                $lead->job_title = ['CEO', 'CTO', 'CMO', 'COO', 'Director', 'Manager', 'VP'][array_rand(['CEO', 'CTO', 'CMO', 'COO', 'Director', 'Manager', 'VP'])];
                $lead->phone = '+1 ' . rand(200, 999) . '-' . rand(100, 999) . '-' . rand(1000, 9999);
                $lead->annual_revenue = '$' . rand(1, 50) . 'M';
                
                // Social media data
                $lead->linkedin_connections = rand(200, 2000);
                $lead->linkedin_joined_date = now()->subYears(rand(1, 8))->format('Y-m-d');
                $lead->linkedin_last_active_date = now()->subDays(rand(1, 30))->format('Y-m-d');
                
                $lead->twitter_connections = rand(500, 10000);
                $lead->twitter_joined_date = now()->subYears(rand(1, 6))->format('Y-m-d');
                $lead->twitter_last_active_date = now()->subDays(rand(1, 20))->format('Y-m-d');
                
                $lead->instagram_connections = rand(200, 5000);
                $lead->instagram_joined_date = now()->subYears(rand(1, 5))->format('Y-m-d');
                $lead->instagram_last_active_date = now()->subDays(rand(1, 15))->format('Y-m-d');
                
                // Generate insights
                $lead->insights = $lead->generateInsights();
                
                // Increment email unlocks used
                $subscription->increment('email_unlocks_used');
            }
        }
        
        $lead->save();
        
        return $lead;
    }
    
    /**
     * Send a Slack notification for the new lead.
     *
     * @param Lead $lead
     * @param User $user
     * @return bool
     */
    private function sendSlackNotification(Lead $lead, User $user): bool
    {
        $slackIntegration = $user->slackIntegration;
        
        if (!$slackIntegration || !$slackIntegration->is_active || !$slackIntegration->notify_on_new_lead) {
            return false;
        }
        
        $blocks = $slackIntegration->createLeadNotification($lead);
        
        return $slackIntegration->sendNotification('New lead captured from ' . $lead->company, $blocks);
    }
} 