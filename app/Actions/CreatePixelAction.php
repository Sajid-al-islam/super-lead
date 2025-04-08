<?php

namespace App\Actions;

use App\Models\Pixel;
use App\Models\User;
use Illuminate\Support\Str;

class CreatePixelAction
{
    /**
     * Create a new pixel for the user.
     *
     * @param User $user
     * @param array $data
     * @return Pixel
     */
    public function handle(User $user, array $data): Pixel
    {
        // Check if user has reached their pixel limit based on subscription
        $this->checkPixelLimit($user);

        $pixel = new Pixel();
        $pixel->user_id = $user->id;
        $pixel->name = $data['name'];
        $pixel->domain = $this->normalizeDomain($data['domain']);
        $pixel->pixel_id = Pixel::generatePixelId();
        $pixel->pixel_code = Pixel::generatePixelCode();
        $pixel->is_active = true;
        $pixel->is_verified = false;
        $pixel->save();

        return $pixel;
    }

    /**
     * Check if user has reached their pixel limit.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    private function checkPixelLimit(User $user): void
    {
        $subscription = $user->activeSubscription;

        if (!$subscription) {
            throw new \Exception('You do not have an active subscription.');
        }

        $currentPixelCount = $user->pixels()->count();
        $maxPixels = $subscription->plan->max_pixels;

        if ($currentPixelCount >= $maxPixels) {
            throw new \Exception("You have reached your limit of {$maxPixels} pixels. Please upgrade your plan to add more pixels.");
        }
    }

    /**
     * Normalize the domain by removing protocol and trailing slashes.
     *
     * @param string $domain
     * @return string
     */
    private function normalizeDomain(string $domain): string
    {
        // Remove protocol
        $domain = preg_replace('(^https?://)', '', $domain);

        // Remove trailing slash
        $domain = rtrim($domain, '/');

        // Remove www if present
        $domain = preg_replace('/^www\./', '', $domain);

        return $domain;
    }
}