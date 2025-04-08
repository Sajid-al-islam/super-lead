<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pixels') }}
            </h2>
            <a href="{{ route('pixels.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create New Pixel') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    @if(count($pixels) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domain</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visitors</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leads</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($pixels as $pixel)
                                        <tr>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pixel->name }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $pixel->domain }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm">
                                                @if($pixel->is_active && $pixel->is_verified)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Active & Verified
                                                    </span>
                                                @elseif($pixel->is_active)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Active (Not Verified)
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($pixel->visitor_count) }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($pixel->lead_count) }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $pixel->created_at->diffForHumans() }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('pixels.show', $pixel) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                    <a href="{{ route('pixels.code', $pixel) }}" class="text-green-600 hover:text-green-900">Get Code</a>
                                                    <a href="{{ route('pixels.test', $pixel) }}" class="text-purple-600 hover:text-purple-900">Test</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg py-8 px-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No pixels found</h3>
                            <p class="text-gray-500 mb-4">You haven't created any pixels yet. Start by creating a new pixel for your website.</p>
                            <a href="{{ route('pixels.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Create New Pixel') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 