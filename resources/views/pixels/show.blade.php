<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Pixel Details') }}: {{ $pixel->name }}
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
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <div class="lg:col-span-2">
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Pixel Information</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Name</p>
                                        <p class="font-medium text-gray-900">{{ $pixel->name }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Domain</p>
                                        <p class="font-medium text-gray-900">{{ $pixel->domain }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Pixel ID</p>
                                        <p class="font-medium text-gray-900">{{ $pixel->pixel_id }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Created</p>
                                        <p class="font-medium text-gray-900">{{ $pixel->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p class="font-medium text-gray-900 flex items-center">
                                            <span class="inline-block w-2 h-2 rounded-full mr-2 {{ $pixel->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                            {{ $pixel->is_active ? 'Active' : 'Inactive' }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Verification</p>
                                        <p class="font-medium text-gray-900 flex items-center">
                                            <span class="inline-block w-2 h-2 rounded-full mr-2 {{ $pixel->is_verified ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                            {{ $pixel->is_verified ? 'Verified' : 'Not Verified' }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Last Activity</p>
                                        <p class="font-medium text-gray-900">{{ $pixel->last_activity ? $pixel->last_activity->format('M d, Y h:i A') : 'No activity yet' }}</p>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex space-x-4">
                                    <a href="{{ route('pixels.code', $pixel) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Get Pixel Code') }}
                                    </a>
                                    <a href="{{ route('pixels.test', $pixel) }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Test Pixel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Performance</h3>
                                
                                <div class="space-y-6">
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Visitors</span>
                                            <span class="text-sm font-medium text-gray-900">{{ number_format($pixel->visitor_count) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Leads</span>
                                            <span class="text-sm font-medium text-gray-900">{{ number_format($pixel->lead_count) }}</span>
                                        </div>
                                        @php
                                            $leadPercentage = $pixel->visitor_count > 0 ? min(100, round(($pixel->lead_count / $pixel->visitor_count) * 100)) : 0;
                                        @endphp
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $leadPercentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Conversion Rate</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $pixel->visitor_count > 0 ? round(($pixel->lead_count / $pixel->visitor_count) * 100, 1) : 0 }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Leads -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Leads</h3>
                            <a href="{{ route('leads.index', ['pixel_id' => $pixel->id]) }}" class="text-sm text-blue-600 hover:text-blue-700">View All Leads</a>
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
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Captured</th>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($leads as $lead)
                                            <tr>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $lead->name ?: 'Unknown' }}</td>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->company }}</td>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->email ?: 'Not available' }}</td>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->job_title ?: 'Unknown' }}</td>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->created_at->diffForHumans() }}</td>
                                                <td class="py-3 px-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 p-4 rounded-lg text-center">
                                <p class="text-gray-600">No leads have been captured by this pixel yet.</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Recent Visitor Data -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Recent Visitors</h3>
                        </div>
                        
                        @if(count($visitorData) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Page URL</th>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Browser/Device</th>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visited</th>
                                            <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($visitorData as $visitor)
                                            <tr>
                                                <td class="py-3 px-4 text-sm text-gray-500 truncate max-w-xs">{{ $visitor->page_url }}</td>
                                                <td class="py-3 px-4 text-sm text-gray-500">{{ $visitor->company_name ?: 'Unknown' }}</td>
                                                <td class="py-3 px-4 text-sm text-gray-500">{{ $visitor->browser ?: 'Unknown' }} / {{ $visitor->device ?: 'Unknown' }}</td>
                                                <td class="py-3 px-4 text-sm text-gray-500">{{ $visitor->created_at->diffForHumans() }}</td>
                                                <td class="py-3 px-4 text-sm">
                                                    @if($visitor->is_processed && $visitor->lead_id)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Converted
                                                        </span>
                                                    @elseif($visitor->is_processed)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Processed
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Pending
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 p-4 rounded-lg text-center">
                                <p class="text-gray-600">No visitors have been tracked by this pixel yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 