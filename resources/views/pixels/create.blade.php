<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Pixel') }}
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

                    <form method="POST" action="{{ route('pixels.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="name" value="{{ __('Pixel Name') }}" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <x-input-label for="domain" value="{{ __('Website Domain') }}" />
                            <x-text-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" required placeholder="https://example.com" />
                            <p class="text-sm text-gray-500 mt-1">Enter the full URL of your website where the pixel will be installed.</p>
                            @error('domain')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('pixels.index') }}" class="text-gray-600 hover:text-gray-900">
                                <span>Cancel</span>
                            </a>

                            <x-primary-button>
                                {{ __('Create Pixel') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
