<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pixel Code') }}: {{ $pixel->name }}
            </h2>
            <a href="{{ route('pixels.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to Pixels') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Installation Instructions</h3>
                        <p class="text-gray-600 mb-4">
                            Copy the code below and paste it into the <code class="bg-gray-200 px-1 py-0.5 rounded">&lt;head&gt;</code> section of your website.
                            This pixel will track anonymous visitors to your website and convert them into leads.
                        </p>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-600">
                                <strong>Important:</strong> Make sure to install the pixel on all pages of your website for the best results.
                            </p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <pre class="bg-gray-800 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"><code>{{ $pixelCode }}</code></pre>
                        <button onclick="copyToClipboard()" class="absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded text-xs">
                            Copy
                        </button>
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <a href="{{ route('pixels.show', $pixel) }}" class="text-blue-600 hover:text-blue-900">
                            <span>View Pixel Details</span>
                        </a>
                        <a href="{{ route('pixels.test', $pixel) }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Test Pixel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function copyToClipboard() {
            const code = `{{ $pixelCode }}`;
            navigator.clipboard.writeText(code)
                .then(() => {
                    const button = event.target;
                    const originalText = button.textContent;
                    button.textContent = 'Copied!';
                    button.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('bg-green-600', 'hover:bg-green-700');
                        button.classList.add('bg-gray-700', 'hover:bg-gray-600');
                    }, 2000);
                })
                .catch(err => {
                    console.error('Failed to copy:', err);
                });
        }
    </script>
</x-app-layout> 