<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\PixelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlackIntegrationController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pixel Routes
    Route::resource('pixels', PixelController::class);
    Route::get('/pixels/{pixel}/code', [PixelController::class, 'code'])->name('pixels.code');
    Route::get('/pixels/{pixel}/test', [PixelController::class, 'test'])->name('pixels.test');
    Route::get('/pixels/{pixel}/test-page', [PixelController::class, 'testPage'])->name('pixels.test_page');

    // Lead Routes
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export');

    // Slack Integration Routes
    Route::get('/slack', [SlackIntegrationController::class, 'edit'])->name('slack.edit');
    Route::post('/slack', [SlackIntegrationController::class, 'store'])->name('slack.store');
    Route::delete('/slack', [SlackIntegrationController::class, 'deactivate'])->name('slack.deactivate');

    // Subscription Routes
    Route::get('/subscriptions/plans', [SubscriptionController::class, 'plans'])->name('subscriptions.plans');
    Route::get('/subscriptions/manage', [SubscriptionController::class, 'manage'])->name('subscriptions.manage');
    Route::post('/subscriptions/{plan}/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::post('/subscriptions/{plan}/upgrade', [SubscriptionController::class, 'upgrade'])->name('subscriptions.upgrade');
    Route::post('/subscriptions/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
});

// Pixel Tracking Route - No auth required
Route::get('/track/{pixelCode}', [PixelController::class, 'track'])->name('pixels.track');

require __DIR__.'/auth.php';
