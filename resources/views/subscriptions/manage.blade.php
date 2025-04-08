<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Subscription') }}
            </h2>
            <a href="{{ route('subscriptions.plans') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('View Plans') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->activeSubscription)
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900">Current Plan</h3>
                            <div class="mt-4 bg-gray-50 rounded-lg p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ auth()->user()->activeSubscription->plan->name }}</h4>
                                        <p class="mt-1 text-gray-600">${{ number_format(auth()->user()->activeSubscription->plan->price, 2) }}/month</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Next billing date</p>
                                        <p class="font-medium">{{ auth()->user()->activeSubscription->ends_at?->format('F j, Y') ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900">Usage</h3>
                            <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-sm font-medium text-gray-600">Pixels</h4>
                                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ auth()->user()->pixels()->count() }}</p>
                                    <p class="mt-1 text-sm text-gray-600">of {{ auth()->user()->activeSubscription->plan->max_pixels }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-sm font-medium text-gray-600">Company Resolutions</h4>
                                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ auth()->user()->company_resolutions_count }}</p>
                                    <p class="mt-1 text-sm text-gray-600">of {{ auth()->user()->activeSubscription->plan->company_resolutions }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-sm font-medium text-gray-600">Email Unlocks</h4>
                                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ auth()->user()->email_unlocks_count }}</p>
                                    <p class="mt-1 text-sm text-gray-600">of {{ auth()->user()->activeSubscription->plan->email_unlocks }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900">Subscription Actions</h3>
                            <div class="mt-4 space-y-4">
                                @if(!auth()->user()->activeSubscription->cancelled())
                                    <form action="{{ route('subscriptions.cancel') }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Cancel Subscription') }}
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-yellow-800">Subscription Cancelled</h3>
                                                <div class="mt-2 text-sm text-yellow-700">
                                                    <p>Your subscription will end on {{ auth()->user()->activeSubscription->ends_at->format('F j, Y') }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No active subscription</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by subscribing to one of our plans.</p>
                            <div class="mt-6">
                                <a href="{{ route('subscriptions.plans') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Plans
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
