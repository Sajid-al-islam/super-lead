<?php

namespace App\Http\Controllers;

use App\Actions\SetupSlackIntegrationAction;
use App\Http\Requests\SetupSlackIntegrationRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SlackIntegrationController extends Controller
{
    /**
     * Show the form for creating or editing a slack integration.
     */
    public function edit(): View
    {
        $user = auth()->user();
        $slackIntegration = $user->slackIntegration;
        
        return view('slack.edit', compact('slackIntegration'));
    }

    /**
     * Store or update a slack integration.
     */
    public function store(SetupSlackIntegrationRequest $request, SetupSlackIntegrationAction $action): RedirectResponse
    {
        try {
            $user = $request->user();
            $slackIntegration = $action->handle($user, $request->validated());
            
            return redirect()->route('dashboard')
                ->with('success', 'Slack integration set up successfully! You will now receive lead notifications in your Slack channel.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    
    /**
     * Deactivate a slack integration.
     */
    public function deactivate(): RedirectResponse
    {
        $user = auth()->user();
        $slackIntegration = $user->slackIntegration;
        
        if ($slackIntegration) {
            $slackIntegration->is_active = false;
            $slackIntegration->save();
            
            return redirect()->route('dashboard')
                ->with('success', 'Slack integration deactivated successfully.');
        }
        
        return redirect()->route('dashboard')
            ->with('error', 'No Slack integration found.');
    }
} 