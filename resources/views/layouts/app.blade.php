<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lead Pixel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="flex">
                <!-- Sidebar -->
                <aside class="w-64 bg-slate-800 text-white min-h-screen fixed hidden md:block">
                    <div class="p-6">
                        <div class="flex items-center mb-8">
                            <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">LP</span>
                            </div>
                            <span class="font-semibold text-xl text-white ml-3">Lead Pixel</span>
                        </div>
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('pixels.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('pixels.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                                <span>Pixels</span>
                            </a>
                            <a href="{{ route('leads.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('leads.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Leads</span>
                            </a>
                            <a href="{{ route('slack.edit') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('slack.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Slack Integration</span>
                            </a>
                            <a href="{{ route('subscriptions.plans') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('subscriptions.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Subscription</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('profile.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 py-3 px-4 rounded-md text-slate-300 hover:bg-slate-700 hover:text-white transition w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1 md:ml-64">
                    <!-- Top Navigation -->
                    <div class="bg-white shadow">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between h-16">
                                <!-- Page Title -->
                                <div class="flex items-center">
            @isset($header)
                        {{ $header }}
                                    @endisset
                                </div>

                                <!-- User Menu -->
                                <div class="flex items-center">
                                    <div class="relative">
                                        <button id="user-menu" class="flex items-center space-x-3 hover:opacity-80 transition">
                                            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center">
                                                <span class="text-white text-sm font-medium">{{ substr(Auth::user()->name, 0, 2) }}</span>
                                            </div>
                                            <span class="text-gray-700">{{ Auth::user()->name }}</span>
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Log Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Page Content -->
                    <main class="py-6">
                {{ $slot }}
            </main>
                </div>
            </div>

            <!-- Mobile Sidebar Toggle -->
            <div class="md:hidden fixed bottom-4 right-4 z-50">
                <button id="sidebar-toggle" class="bg-red-500 text-white p-3 rounded-full shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Sidebar -->
            <div id="mobile-sidebar" class="fixed inset-0 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-y-0 left-0 w-64 bg-slate-800 text-white overflow-y-auto">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">LP</span>
                                </div>
                                <span class="font-semibold text-xl text-white ml-3">Lead Pixel</span>
                            </div>
                            <button id="close-sidebar" class="text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <nav class="space-y-1">
                            <!-- Mobile Navigation Items -->
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('pixels.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('pixels.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                                <span>Pixels</span>
                            </a>
                            <a href="{{ route('leads.index') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('leads.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Leads</span>
                            </a>
                            <a href="{{ route('slack.edit') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('slack.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span>Slack Integration</span>
                            </a>
                            <a href="{{ route('subscriptions.plans') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('subscriptions.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Subscription</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 py-3 px-4 rounded-md {{ request()->routeIs('profile.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 py-3 px-4 rounded-md text-slate-300 hover:bg-slate-700 hover:text-white transition w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Menu JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const userMenu = document.getElementById('user-menu');
                const userDropdown = document.getElementById('user-dropdown');

                if (userMenu && userDropdown) {
                    userMenu.addEventListener('click', function() {
                        userDropdown.classList.toggle('hidden');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!userMenu.contains(e.target)) {
                            userDropdown.classList.add('hidden');
                        }
                    });
                }

                // Mobile sidebar JavaScript
                const toggleButton = document.getElementById('sidebar-toggle');
                const closeButton = document.getElementById('close-sidebar');
                const mobileSidebar = document.getElementById('mobile-sidebar');

                if (toggleButton && mobileSidebar) {
                    toggleButton.addEventListener('click', function() {
                        mobileSidebar.classList.remove('-translate-x-full');
                    });
                }

                if (closeButton && mobileSidebar) {
                    closeButton.addEventListener('click', function() {
                        mobileSidebar.classList.add('-translate-x-full');
                    });

                    mobileSidebar.addEventListener('click', function(e) {
                        if (e.target === mobileSidebar) {
                            mobileSidebar.classList.add('-translate-x-full');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
