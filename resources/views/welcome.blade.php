<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lead Pixel - Smart B2B Lead Generation</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-900 to-slate-800 text-white">
        <div class="min-h-screen flex flex-col">
            <header class="py-4 px-6 md:px-10 lg:px-16 flex justify-between items-center border-b border-slate-700">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">LP</span>
                    </div>
                    <span class="font-semibold text-xl text-white">Lead Pixel</span>
                </div>
                
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="#features" class="text-slate-300 hover:text-white transition">Features</a>
                    <a href="#pricing" class="text-slate-300 hover:text-white transition">Pricing</a>
                    <a href="#about" class="text-slate-300 hover:text-white transition">About</a>
                    
            @if (Route::has('login'))
                        <div class="flex space-x-3">
                    @auth
                                <a href="{{ url('/dashboard') }}" class="py-2 px-4 rounded-lg bg-red-500 hover:bg-red-600 transition text-white font-medium">
                            Dashboard
                        </a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="py-2 px-4 rounded-lg border border-slate-600 hover:border-slate-400 transition text-white">
                                        Log Out
                                    </button>
                                </form>
                    @else
                                <a href="{{ route('login') }}" class="py-2 px-4 rounded-lg border border-slate-600 hover:border-slate-400 transition text-white">
                            Log in
                        </a>
                        @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="py-2 px-4 rounded-lg bg-red-500 hover:bg-red-600 transition text-white font-medium">
                                Register
                            </a>
                        @endif
                    @endauth
                        </div>
                    @endif
                </nav>
                
                <!-- Mobile menu button -->
                <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
        </header>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-slate-800 border-b border-slate-700">
                <div class="px-6 py-4 space-y-4">
                    <a href="#features" class="block text-slate-300 hover:text-white transition">Features</a>
                    <a href="#pricing" class="block text-slate-300 hover:text-white transition">Pricing</a>
                    <a href="#about" class="block text-slate-300 hover:text-white transition">About</a>
                    
                    @if (Route::has('login'))
                        <div class="pt-4 space-y-3 border-t border-slate-700">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block py-2 px-4 rounded-lg bg-red-500 hover:bg-red-600 transition text-white font-medium text-center">
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full py-2 px-4 rounded-lg border border-slate-600 hover:border-slate-400 transition text-white">
                                        Log Out
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block py-2 px-4 rounded-lg border border-slate-600 hover:border-slate-400 transition text-white text-center">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block py-2 px-4 rounded-lg bg-red-500 hover:bg-red-600 transition text-white font-medium text-center">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
            
            <main class="flex-grow">
                <!-- Hero Section -->
                <section class="py-20 px-6 md:px-10 lg:px-16 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
                    <div class="max-w-2xl mb-10 md:mb-0">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                            Identify Your Website <span class="text-red-500">Visitors</span> <br>
                            Convert Them to <span class="text-red-500">Leads</span>
                        </h1>
                        <p class="text-xl text-slate-300 mb-8">
                            Powerful B2B lead generation pixel that turns anonymous website visitors into qualified sales leads with company and contact information.
                        </p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="py-3 px-8 bg-red-500 hover:bg-red-600 transition text-white font-medium rounded-lg text-lg">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="py-3 px-8 bg-red-500 hover:bg-red-600 transition text-white font-medium rounded-lg text-lg">
                                    Start Free Trial
                                </a>
                                <a href="#demo" class="py-3 px-8 border border-slate-600 hover:border-slate-400 transition text-white rounded-lg text-lg">
                                    Watch Demo
                                </a>
                            @endauth
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <img src="https://placehold.co/500x400/294057/FFFFFF?text=Dashboard+Preview" alt="Dashboard Preview" class="rounded-lg shadow-xl">
                    </div>
                </section>
                
                <!-- Features Section -->
                <section id="features" class="py-20 px-6 md:px-10 lg:px-16 bg-slate-800">
                    <h2 class="text-3xl font-bold text-center mb-16">Powerful Features</h2>
                    <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Visitor Tracking</h3>
                            <p class="text-slate-300">Identify the companies visiting your website in real-time with accurate company data.</p>
                        </div>
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Contact Resolution</h3>
                            <p class="text-slate-300">Unlock business emails and social profiles of key decision-makers at visiting companies.</p>
                        </div>
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Slack Notifications</h3>
                            <p class="text-slate-300">Get real-time Slack alerts when high-value prospects visit your website.</p>
                        </div>
                </div>
                </section>
                
                <!-- Call to Action -->
                <section class="py-20 px-6 md:px-10 lg:px-16 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Convert Visitors into Leads?</h2>
                    <p class="text-xl text-slate-300 mb-10 max-w-3xl mx-auto">
                        Get started with Lead Pixel today and never miss a potential customer again.
                    </p>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="py-3 px-8 bg-red-500 hover:bg-red-600 transition text-white font-medium rounded-lg text-lg inline-block">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="py-3 px-8 bg-red-500 hover:bg-red-600 transition text-white font-medium rounded-lg text-lg inline-block">
                            Start Your Free Trial
                        </a>
                    @endauth
                </section>
            </main>
            
            <footer class="py-8 px-6 md:px-10 lg:px-16 border-t border-slate-700">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2 mb-4 md:mb-0">
                        <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center">
                            <span class="text-white font-bold text-sm">LP</span>
                        </div>
                        <span class="font-semibold text-white">Lead Pixel</span>
                    </div>
                    <div class="text-slate-400 text-sm">
                        &copy; {{ date('Y') }} Lead Pixel. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function toggleMobileMenu() {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            }
        </script>
    </body>
</html>
