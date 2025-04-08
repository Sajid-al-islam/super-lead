<?php

namespace App\Actions;

use App\Models\Pixel;
use App\Models\VisitorData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CaptureVisitorDataAction
{
    /**
     * Capture visitor data from a pixel request.
     *
     * @param Request $request
     * @param string $pixelCode
     * @return VisitorData|null
     */
    public function handle(Request $request, string $pixelCode): ?VisitorData
    {
        try {
            // Find the pixel by code
            $pixel = Pixel::query()->where('pixel_code', $pixelCode)->where('is_active', true)->first();
            
            if (!$pixel) {
                return null;
            }
            
            // Check domain referrer to verify the pixel is being used on the correct domain
            $referrer = $request->header('referer');
            $domain = $pixel->domain;
            
            if ($referrer && !$pixel->is_verified) {
                $referrerDomain = $this->extractDomain($referrer);
                
                if ($referrerDomain && str_contains($referrerDomain, $domain)) {
                    $pixel->is_verified = true;
                    $pixel->save();
                }
            }
            
            // Update last activity
            $pixel->last_activity = now();
            $pixel->increment('visitor_count');
            $pixel->save();
            
            // Create visitor data record
            $visitorData = new VisitorData();
            $visitorData->pixel_id = $pixel->id;
            $visitorData->ip_address = $request->ip();
            $visitorData->user_agent = $request->userAgent();
            $visitorData->referrer = $referrer;
            $visitorData->page_url = $request->input('page_url', $referrer);
            
            // Parse user agent
            $userAgentData = $visitorData->parseUserAgent();
            $visitorData->browser = $userAgentData['browser'];
            $visitorData->device = $userAgentData['device'];
            $visitorData->operating_system = $userAgentData['operating_system'];
            
            // Get location data if available
            if ($request->has('geo')) {
                $visitorData->country = $request->input('geo.country');
                $visitorData->city = $request->input('geo.city');
            }
            
            $visitorData->save();
            
            return $visitorData;
        } catch (Exception $e) {
            Log::error('Error capturing visitor data: ' . $e->getMessage(), [
                'pixel_code' => $pixelCode,
                'exception' => $e,
            ]);
            
            return null;
        }
    }
    
    /**
     * Extract domain from URL.
     *
     * @param string $url
     * @return string|null
     */
    private function extractDomain(string $url): ?string
    {
        $parsedUrl = parse_url($url);
        
        if (isset($parsedUrl['host'])) {
            return preg_replace('/^www\./', '', $parsedUrl['host']);
        }
        
        return null;
    }
} 