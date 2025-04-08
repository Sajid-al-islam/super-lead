<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Leads') }}
            </h2>
            <a href="{{ route('leads.export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Export to CSV') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filters -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('leads.index') }}" class="flex flex-wrap items-end space-x-4">
                            <div class="w-full sm:w-auto mb-4 sm:mb-0">
                                <x-input-label for="pixel_id" value="{{ __('Filter by Pixel') }}" />
                                <select id="pixel_id" name="pixel_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                    <option value="">All Pixels</option>
                                    @foreach($pixels as $id => $name)
                                        <option value="{{ $id }}" {{ request('pixel_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full sm:w-auto mb-4 sm:mb-0">
                                <x-input-label for="search" value="{{ __('Search') }}" />
                                <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" :value="request('search')" placeholder="Search name, email, company..." />
                            </div>
                            <div>
                                <x-primary-button>
                                    {{ __('Filter') }}
                                </x-primary-button>
                                @if(request('pixel_id') || request('search'))
                                    <a href="{{ route('leads.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Clear') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if(count($leads) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pixel</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Captured</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($leads as $lead)
                                        <tr>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lead->name ?: 'Unknown' }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->company }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->email ?: 'Not available' }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->job_title ?: 'Unknown' }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->pixel->name }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->created_at->diffForHumans() }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $leads->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg py-8 px-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No leads found</h3>
                            <p class="text-gray-500 mb-4">
                                @if(request('pixel_id') || request('search'))
                                    No leads match your search criteria. Try adjusting your filters.
                                @else
                                    You don't have any leads yet. Make sure you have installed your pixel on your website to start capturing leads.
                                @endif
                            </p>
                            @if(request('pixel_id') || request('search'))
                                <a href="{{ route('leads.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Clear Filters') }}
                                </a>
                            @else
                                <a href="{{ route('pixels.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Manage Your Pixels') }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
