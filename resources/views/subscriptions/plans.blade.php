<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Subscription Plans') }}
            </h2>
            @if(auth()->user()->activeSubscription)
                <a href="{{ route('subscriptions.manage') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Manage Subscription') }}
                </a>
            @endif
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
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900">Choose the Right Plan for Your Business</h3>
                        <p class="mt-2 text-gray-600">Upgrade your plan to unlock more features and increase your lead generation capabilities.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($plans as $plan)
                            <div class="border rounded-lg overflow-hidden {{ $plan->is_featured ? 'border-blue-500 shadow-lg' : 'border-gray-200' }}">
                                @if($plan->is_featured)
                                    <div class="bg-blue-500 text-white text-center py-2 font-semibold">
                                        Most Popular
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $plan->name }}</h3>
                                    <div class="mt-4 flex items-baseline">
                                        <span class="text-4xl font-extrabold text-gray-900">${{ number_format($plan->price, 2) }}</span>
                                        <span class="ml-1 text-gray-500">/month</span>
                                    </div>
                                    <p class="mt-5 text-gray-500">{{ $plan->description ?? 'Perfect for growing businesses' }}</p>
                                    <ul class="mt-6 space-y-4">
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $plan->max_pixels }} pixels</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $plan->company_resolutions }} company resolutions</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $plan->email_unlocks }} email unlocks</span>
                                        </li>
                                        @if($plan->has_slack_notifications)
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>Slack notifications</span>
                                            </li>
                                        @endif
                                        @if($plan->has_csv_exports)
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>CSV exports</span>
                                            </li>
                                        @endif
                                        @if($plan->has_trial)
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>{{ $plan->trial_days }} days free trial</span>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="mt-8">
                                        @if(auth()->user()->activeSubscription)
                                            @if(auth()->user()->activeSubscription->plan_id === $plan->id)
                                                <button disabled class="w-full bg-gray-300 text-gray-700 py-2 px-4 rounded-md font-medium">
                                                    Current Plan
                                                </button>
                                            @else
                                                <form action="{{ route('subscriptions.upgrade', $plan) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                        Upgrade to {{ $plan->name }}
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <form action="{{ route('subscriptions.subscribe', $plan) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                    Subscribe to {{ $plan->name }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
