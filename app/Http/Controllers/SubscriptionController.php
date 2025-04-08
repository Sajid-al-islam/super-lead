<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display the plans page.
     */
    public function plans()
    {
        $plans = Plan::where('is_active', true)->get();
        $currentPlan = Auth::user()->activeSubscription?->plan;

        return view('subscriptions.plans', compact('plans', 'currentPlan'));
    }

    /**
     * Display the subscription management page.
     */
    public function manage()
    {
        $subscription = Auth::user()->activeSubscription;
        $plans = Plan::where('is_active', true)->get();

        return view('subscriptions.manage', compact('subscription', 'plans'));
    }

    /**
     * Subscribe to a plan.
     */
    public function subscribe(Request $request, Plan $plan)
    {
        $user = Auth::user();

        // Check if user already has an active subscription
        if ($user->activeSubscription) {
            return redirect()->route('subscriptions.manage')
                ->with('error', 'You already have an active subscription.');
        }

        // Create a new subscription
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $plan->id;
        $subscription->starts_at = now();
        $subscription->ends_at = now()->addMonth();
        $subscription->is_active = true;
        $subscription->status = 'active';

        // If plan has trial, set trial
        if ($plan->has_trial) {
            $subscription->is_trial = true;
            $subscription->ends_at = now()->addDays($plan->trial_days);
        }

        $subscription->save();

        return redirect()->route('subscriptions.manage')
            ->with('success', 'You have successfully subscribed to the ' . $plan->name . ' plan.');
    }

    /**
     * Upgrade to a different plan.
     */
    public function upgrade(Request $request, Plan $plan)
    {
        $user = Auth::user();
        $currentSubscription = $user->activeSubscription;

        // Check if user has an active subscription
        if (!$currentSubscription) {
            return redirect()->route('subscriptions.plans')
                ->with('error', 'You do not have an active subscription.');
        }

        // Check if the new plan is different from the current plan
        if ($currentSubscription->plan_id === $plan->id) {
            return redirect()->route('subscriptions.manage')
                ->with('error', 'You are already subscribed to this plan.');
        }

        // Deactivate the current subscription
        $currentSubscription->is_active = false;
        $currentSubscription->save();

        // Create a new subscription
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $plan->id;
        $subscription->starts_at = now();
        $subscription->ends_at = now()->addMonth();
        $subscription->is_active = true;
        $subscription->status = 'active';
        $subscription->save();

        return redirect()->route('subscriptions.manage')
            ->with('success', 'You have successfully upgraded to the ' . $plan->name . ' plan.');
    }

    /**
     * Cancel the current subscription.
     */
    public function cancel()
    {
        $user = Auth::user();
        $subscription = $user->activeSubscription;

        // Check if user has an active subscription
        if (!$subscription) {
            return redirect()->route('subscriptions.manage')
                ->with('error', 'You do not have an active subscription.');
        }

        // Check if subscription is already cancelled
        if ($subscription->cancelled()) {
            return redirect()->route('subscriptions.manage')
                ->with('error', 'Your subscription is already cancelled.');
        }

        // Cancel the subscription
        if ($subscription->cancel()) {
            return redirect()->route('subscriptions.manage')
                ->with('success', 'Your subscription has been cancelled and will end on ' . $subscription->ends_at->format('F j, Y') . '.');
        }

        return redirect()->route('subscriptions.manage')
            ->with('error', 'There was an error cancelling your subscription. Please try again.');
    }
}
