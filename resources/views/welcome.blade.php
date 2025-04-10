<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lead Pixel - Turn Anonymous Visitors into B2B Leads</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-50 to-white">
        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="py-6 px-6 md:px-10 lg:px-16 bg-white/70 backdrop-blur-lg sticky top-0 z-50">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center transform rotate-12 hover:rotate-0 transition-transform duration-300">
                            <span class="text-white font-bold text-lg transform -rotate-12 group-hover:rotate-0">LP</span>
                        </div>
                        <span class="font-semibold text-xl bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Lead Pixel</span>
                    </div>

                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300">Pricing</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300">Blog</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 transition-colors duration-300">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 font-medium">
                                        Get started
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </nav>

                    <button class="md:hidden text-gray-600" onclick="toggleMobileMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white/70 backdrop-blur-lg border-b border-gray-100">
                <div class="px-6 py-4 space-y-4">
                    <a href="#" class="block text-gray-600 hover:text-indigo-600 transition-colors duration-300">Pricing</a>
                    <a href="#" class="block text-gray-600 hover:text-indigo-600 transition-colors duration-300">Blog</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="block text-gray-600 hover:text-indigo-600 transition-colors duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block text-gray-600 hover:text-indigo-600 transition-colors duration-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block mt-4 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-center rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300">
                                    Get started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <main class="flex-grow">
                <!-- Hero Section -->
                <section class="py-20 px-6 md:px-10 lg:px-16 relative overflow-hidden">
                    <!-- Background Elements -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute w-[500px] h-[500px] bg-indigo-100 rounded-full -top-48 -right-24 blur-3xl opacity-20"></div>
                        <div class="absolute w-[400px] h-[400px] bg-purple-100 rounded-full -bottom-32 -left-24 blur-3xl opacity-20"></div>
                    </div>

                    <div class="max-w-7xl mx-auto relative">
                        <div class="max-w-4xl mx-auto text-center mb-20">
                            <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Turn anonymous visitors into B2B leads.
                            </h1>
                            <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                                Identify companies visiting your website and get access to decision-makers' emails.
                            </p>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Go to Dashboard
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Join waitlist
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endauth
                        </div>

                        <!-- Lead Card Preview -->
                        <div class="relative max-w-lg mx-auto perspective-1000">
                            <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-rotate-1">
                                <div class="absolute -top-3 -right-3 bg-gradient-to-r from-green-400 to-green-500 text-white px-4 py-1 rounded-full text-sm font-medium">
                                    Online now
                                </div>

                                <div class="flex items-start space-x-6 mb-6">
                                    <div class="relative">
                                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                            <span class="text-2xl font-bold bg-gradient-to-br from-indigo-600 to-purple-600 bg-clip-text text-transparent">A</span>
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <h3 class="text-xl font-semibold text-gray-900">Acme Inc.</h3>
                                            <span class="text-sm text-gray-500">2 mins ago</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">Technology · San Francisco, CA</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-600">Contact Person</span>
                                            <span class="text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-full">Decision Maker</span>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <img src="https://i.pravatar.cc/100?img=13" alt="Contact Avatar" class="w-10 h-10 rounded-full">
                                            <div>
                                                <h4 class="font-medium text-gray-900">Sarah Anderson</h4>
                                                <p class="text-sm text-gray-600">VP of Marketing</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <span class="text-sm text-gray-500">Annual Revenue</span>
                                            <p class="font-semibold text-gray-900">$50M - $100M</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <span class="text-sm text-gray-500">Employee Count</span>
                                            <p class="font-semibold text-gray-900">250 - 500</p>
                                        </div>
                                    </div>

                                    <div class="flex justify-end space-x-3">
                                        <button class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-300">
                                            View Details
                                        </button>
                                        <button class="px-4 py-2 text-sm font-medium bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-lg hover:shadow-md transition-all duration-300">
                                            Connect
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Features Section -->
                <section class="py-20 px-6 md:px-10 lg:px-16 relative">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                                How Lead Pixel Works
                            </h2>
                            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                                Turn anonymous website visitors into qualified B2B leads with our powerful tracking and identification platform.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                            <!-- Feature 1: Visitor Tracking -->
                            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Visitor Tracking</h3>
                                <p class="text-gray-600 mb-4">
                                    Install a simple tracking pixel on your website to identify companies visiting your site in real-time, without collecting personal data.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Real-time company identification</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Easy installation</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Privacy compliant</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Feature 2: Lead Generation -->
                            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Lead Generation</h3>
                                <p class="text-gray-600 mb-4">
                                    Access company profiles and unlock decision-maker contact information to connect with qualified prospects.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Decision-maker contact data</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Company firmographics</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Verified business emails</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Feature 3: Integrations -->
                            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-2xl flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Instant Notifications</h3>
                                <p class="text-gray-600 mb-4">
                                    Get real-time alerts when high-value prospects visit your website and take immediate action.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Slack notifications</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">Customizable alerts</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">CSV exports</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- How It Works Section -->
                <section class="py-20 px-6 md:px-10 lg:px-16 bg-gradient-to-br from-indigo-50 to-purple-50">
                    <div class="max-w-7xl mx-auto">
                        <div class="text-center mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                                Simple Setup, Powerful Results
                            </h2>
                            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                                Getting started with Lead Pixel takes just minutes. Here's how it works:
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="text-center">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold flex items-center justify-center mx-auto mb-4">1</div>
                                    <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-indigo-200"></div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Add the Pixel</h3>
                                <p class="text-gray-600">Install our tracking code on your website with a simple copy and paste.</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold flex items-center justify-center mx-auto mb-4">2</div>
                                    <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-indigo-200"></div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Identify Visitors</h3>
                                <p class="text-gray-600">We automatically identify companies visiting your site in real-time.</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold flex items-center justify-center mx-auto mb-4">3</div>
                                    <div class="hidden md:block absolute top-8 left-full w-full h-0.5 bg-indigo-200"></div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Get Contact Info</h3>
                                <p class="text-gray-600">Unlock decision-maker contact details at visiting companies.</p>
                            </div>
                            
                            <div class="text-center">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold flex items-center justify-center mx-auto mb-4">4</div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Convert to Sales</h3>
                                <p class="text-gray-600">Reach out while your company is top-of-mind for highest conversion rates.</p>
                            </div>
                        </div>
                        
                        <div class="mt-16 text-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Go to Dashboard
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Start Free Trial
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                </section>

                <section class="py-20 px-6 md:px-10 lg:px-16 text-center relative overflow-hidden">
                    <!-- Background Elements -->
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute w-[500px] h-[500px] bg-indigo-100 rounded-full -top-48 -right-24 blur-3xl opacity-20"></div>
                        <div class="absolute w-[400px] h-[400px] bg-purple-100 rounded-full -bottom-32 -left-24 blur-3xl opacity-20"></div>
                    </div>

                    <div class="max-w-7xl mx-auto relative">
                        <div class="max-w-4xl mx-auto mb-16">
                            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                                Ready to Convert Visitors into Leads?
                            </h2>
                            <p class="text-lg text-gray-600">
                                Join thousands of B2B companies using Lead Pixel to identify and contact their website visitors.
                            </p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 max-w-3xl mx-auto relative">
                            <div class="absolute -top-3 -right-3 bg-gradient-to-r from-green-400 to-green-500 text-white px-4 py-1 rounded-full text-sm font-medium">
                                Limited Time Offer
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Get Started with 14 Days Free</h3>
                            <p class="text-gray-600 mb-8">No credit card required. Cancel anytime.</p>
                            
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Go to Dashboard
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300 text-lg font-medium group">
                                    Start Free Trial
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                </section>
            </main>

            <style>
                .perspective-1000 {
                    perspective: 1000px;
                }
                @font-face {
                    font-family: 'Outfit';
                    font-style: normal;
                    font-weight: 400;
                    font-display: swap;
                    src: url(https://fonts.bunny.net/outfit/files/outfit-latin-400-normal.woff2) format('woff2');
                }
            </style>

            <script>
                function toggleMobileMenu() {
                    const mobileMenu = document.getElementById('mobile-menu');
                    mobileMenu.classList.toggle('hidden');
                }
            </script>
        </div>
    </body>
</html>
