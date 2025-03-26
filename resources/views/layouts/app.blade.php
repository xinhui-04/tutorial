<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-base-100">
            @if (Auth::user()->role == 'user')
            <header x-data="{ open: false }" class="bg-primary/20 dark:bg-neutral shadow-2xl">
                <div class="border-b border-primary/10 dark:border-gray-700 p-2">
                    <p class="container max-w-7xl mx-auto font-semibold text-sm">Welcome to Metro</p>
                </div>
                <nav class="container max-w-7xl mx-auto navbar py-6">
                    <div class="navbar-start">
                        <a href="/"><x-application-logo class="h-12 w-auto" /></a>
                    </div>
                    <div class="navbar-center hidden space-x-4 sm:flex items-center">
                        <x-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                            {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                            {{ __('About Us') }}
                        </x-nav-link>
                        <x-nav-link class="py-2" href="{{ url('contact') }}" :active="request()->is('contact')">
                            {{ __('Contact Us') }}
                        </x-nav-link>
                    </div>
                    <div class="navbar-end">
                        @if (Route::has('login'))
                            <nav class="flex justify-between items-center">
                                <div>
                                    @auth
                                    @if (Auth::user()->role == 'user')
                                    <x-customer-nav />
                                        
                                    @else
                                    <a type="button" class="btn btn-ghost" href="{{ route('dashboard') }}">Dashboard</a>
                                    @endif
                                    @else
                                        <a type="button" class="btn btn-ghost" href="{{ route('login') }}">Login</a>
        
                                        @if (Route::has('register'))
                                            <a type="button" class="btn btn-outline" href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            </nav>
                        @endif

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    
                </nav>
                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link class="py-2" :href="'/'" :active="request()->is('/')">
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link class="py-2" :href="'/about'" :active="request()->is('about')">
                            {{ __('About Us') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link class="py-2" href="{{ url('contact') }}" :active="request()->is('contact')">
                            {{ __('Contact Us') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            @if (Auth::user()->role == 'user')
                            <a type="button" class="btn btn-link" href="{{ url('/') }}">Orders</a>
                            @endif
                            <x-responsive-nav-link :href="route('profile.edit', Auth::user()->id)">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            @else
                
            @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-base-100 shadow">
                    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
