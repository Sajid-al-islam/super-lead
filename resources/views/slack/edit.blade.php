<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Slack Integration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.5 2c1.381 0 2.5 1.119 2.5 2.5v15c0 1.381-1.119 2.5-2.5 2.5h-13c-1.381 0-2.5-1.119-2.5-2.5v-15c0-1.381 1.119-2.5 2.5-2.5h13zm0-2h-13c-2.486 0-4.5 2.014-4.5 4.5v15c0 2.486 2.014 4.5 4.5 4.5h13c2.486 0 4.5-2.014 4.5-4.5v-15c0-2.486-2.014-4.5-4.5-4.5zm-7.5 16h-3v3h3v-3zm0-5h-3v3h3v-3zm0-5h-3v3h3v-3zm10-3h-16v-2h16v2zm-5 13h-3v3h3v-3zm0-5h-3v3h3v-3zm0-5h-3v3h3v-3z"/>
                            </svg>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Why Integrate with Slack?</h3>
                                <p class="text-gray-600 mb-3">
                                    Connecting Lead Pixel to your Slack workspace lets you receive instant notifications when new leads are captured.
                                    Your team can respond quickly to new opportunities as they come in.
                                </p>
                                <p class="text-gray-600">
                                    You'll need to create a Slack Webhook URL to connect your workspace.
                                    <a href="https://api.slack.com/messaging/webhooks" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        Learn how to create a Slack webhook &rarr;
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('slack.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="webhook_url" value="{{ __('Slack Webhook URL') }}" />
                            <x-text-input id="webhook_url" class="block mt-1 w-full" type="text" name="webhook_url" :value="$slackIntegration->webhook_url ?? old('webhook_url')" required autofocus placeholder="https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX" />
                            <p class="text-sm text-gray-500 mt-1">Enter the webhook URL from your Slack workspace.</p>
                            @error('webhook_url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="channel" value="{{ __('Slack Channel (Optional)') }}" />
                            <x-text-input id="channel" class="block mt-1 w-full" type="text" name="channel" :value="$slackIntegration->channel ?? old('channel')" placeholder="#leads or #sales" />
                            <p class="text-sm text-gray-500 mt-1">Enter the channel where notifications should be sent. Leave blank to use the default channel from your webhook.</p>
                            @error('channel')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-900 mb-3">Notification Settings</h3>

                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_on_new_lead" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="1" {{ ($slackIntegration->notify_on_new_lead ?? true) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Notify on new lead captured</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_on_company_resolution" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="1" {{ ($slackIntegration->notify_on_company_resolution ?? false) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Notify on company resolution</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="notify_on_email_unlock" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="1" {{ ($slackIntegration->notify_on_email_unlock ?? false) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Notify on email unlock</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            @if($slackIntegration && $slackIntegration->is_active)
                                <form method="POST" action="{{ route('slack.deactivate') }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="bg-red-600 hover:bg-red-700 active:bg-red-800 focus:ring-red-500">
                                        {{ __('Deactivate Integration') }}
                                    </x-primary-button>
                                </form>
                            @else
                                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                                    <span>Cancel</span>
                                </a>
                            @endif

                            <x-primary-button>
                                {{ $slackIntegration ? __('Update Integration') : __('Connect to Slack') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
