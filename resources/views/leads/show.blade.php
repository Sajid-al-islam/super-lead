<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lead Details') }}
            </h2>
            <a href="{{ route('leads.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Back to Leads') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Lead Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white">
                            <h3 class="text-2xl font-semibold mb-1">{{ $lead->name ?: 'Unknown Name' }}</h3>
                            <p class="text-lg opacity-90">{{ $lead->job_title ?: 'Unknown Position' }} at {{ $lead->company }}</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-gray-600">{{ $lead->email ?: 'Email not available' }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <span class="text-gray-600">{{ $lead->phone ?: 'Phone not available' }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <span class="text-gray-600">{{ $lead->company }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-600">Annual Revenue: {{ $lead->annual_revenue ?: 'Unknown' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Social Media Profiles</h4>
                                    <div class="space-y-4">
                                        <div class="bg-gray-50 p-3 rounded">
                                            <div class="flex items-center mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                                                </svg>
                                                <h5 class="font-medium">LinkedIn</h5>
                                            </div>
                                            <div class="pl-7 text-sm text-gray-600 space-y-1">
                                                <p>Connections: {{ number_format($lead->linkedin_connections ?: 0) }}</p>
                                                <p>Joined: {{ $lead->linkedin_joined_date ? $lead->linkedin_joined_date->format('M Y') : 'Unknown' }}</p>
                                                <p>Last Active: {{ $lead->linkedin_last_active_date ? $lead->linkedin_last_active_date->format('M Y') : 'Unknown' }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 p-3 rounded">
                                            <div class="flex items-center mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                                </svg>
                                                <h5 class="font-medium">Twitter</h5>
                                            </div>
                                            <div class="pl-7 text-sm text-gray-600 space-y-1">
                                                <p>Followers: {{ number_format($lead->twitter_connections ?: 0) }}</p>
                                                <p>Joined: {{ $lead->twitter_joined_date ? $lead->twitter_joined_date->format('M Y') : 'Unknown' }}</p>
                                                <p>Last Active: {{ $lead->twitter_last_active_date ? $lead->twitter_last_active_date->format('M Y') : 'Unknown' }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 p-3 rounded">
                                            <div class="flex items-center mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                                </svg>
                                                <h5 class="font-medium">Instagram</h5>
                                            </div>
                                            <div class="pl-7 text-sm text-gray-600 space-y-1">
                                                <p>Followers: {{ number_format($lead->instagram_connections ?: 0) }}</p>
                                                <p>Joined: {{ $lead->instagram_joined_date ? $lead->instagram_joined_date->format('M Y') : 'Unknown' }}</p>
                                                <p>Last Active: {{ $lead->instagram_last_active_date ? $lead->instagram_last_active_date->format('M Y') : 'Unknown' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <h4 class="text-lg font-medium text-blue-900 mb-2">Insights</h4>
                                <p class="text-blue-800">{{ $lead->insights ?: $lead->generateInsights() }}</p>
                            </div>
                            
                            <div class="border-t pt-4">
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>Captured via: {{ $lead->pixel->name }}</span>
                                    <span>{{ $lead->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Visitor Data History -->
                    @if(count($visitorData) > 0)
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Visit History</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Page</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Browser</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                        <th class="py-3 px-4 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Time</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($visitorData as $visit)
                                        <tr>
                                            <td class="py-3 px-4 text-sm text-gray-600 truncate max-w-xs">{{ $visit->page_url }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $visit->browser ?: 'Unknown' }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $visit->device ?: 'Unknown' }} / {{ $visit->operating_system ?: 'Unknown OS' }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $visit->city && $visit->country ? $visit->city . ', ' . $visit->country : 'Unknown location' }}</td>
                                            <td class="py-3 px-4 text-sm text-gray-600">{{ $visit->created_at->format('M d, Y h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 