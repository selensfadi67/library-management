<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', __('messages.home_title'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('home', app()->getLocale()) }}" class="text-2xl font-bold text-blue-600">
                                📚 {{ __('messages.books') }}
                            </a>
                        </div>
                        
                        <!-- Navigation Links -->
                        <div class="hidden md:ml-6 md:flex md:space-x-8">
                            <a href="{{ route('home', app()->getLocale()) }}" 
                               class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                                {{ __('messages.home_title') }}
                            </a>
                            <a href="{{ route('books.index', app()->getLocale()) }}" 
                               class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                                {{ __('messages.all_books') }}
                            </a>
                            <a href="{{ route('contact', app()->getLocale()) }}" 
                               class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                                {{ __('messages.contact_us') }}
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right side -->
                    <div class="flex items-center space-x-4">
                        <!-- Language Switcher -->
                        <div class="flex space-x-2">
                            <a href="{{ str_replace('/' . app()->getLocale(), '/en', request()->url()) }}" 
                               class="px-3 py-2 text-sm font-medium {{ app()->getLocale() == 'en' ? 'text-blue-600 bg-blue-50' : 'text-gray-500 hover:text-gray-700' }} rounded-md">
                                EN
                            </a>
                            <a href="{{ str_replace('/' . app()->getLocale(), '/ar', request()->url()) }}" 
                               class="px-3 py-2 text-sm font-medium {{ app()->getLocale() == 'ar' ? 'text-blue-600 bg-blue-50' : 'text-gray-500 hover:text-gray-700' }} rounded-md">
                                عربي
                            </a>
                        </div>
                        
                        <!-- Authentication Links -->
                        @auth
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">{{ __('messages.welcome') ?? 'Welcome' }}, {{ auth()->user()->name }}</span>
                                <span class="text-sm text-green-600 font-semibold">${{ number_format(auth()->user()->balance, 2) }}</span>
                                <form method="POST" action="{{ route('customer.logout', app()->getLocale()) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium">
                                        {{ __('messages.logout') }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('customer.login', app()->getLocale()) }}" 
                                   class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium">
                                    {{ __('messages.login') }}
                                </a>
                                <a href="{{ route('customer.register', app()->getLocale()) }}" 
                                   class="bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 text-sm font-medium rounded-md">
                                    {{ __('messages.register') }}
                                </a>
                            </div>
                        @endauth
                        
                        <!-- Admin Panel Link -->
                        <a href="{{ route('admin.login', app()->getLocale()) }}" 
                           class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium">
                            {{ __('messages.admin_panel') }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">{{ __('messages.books') }}</h3>
                        <p class="text-gray-300">{{ __('messages.welcome_home') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">{{ __('messages.contact_us') }}</h3>
                        <p class="text-gray-300">{{ __('messages.get_in_touch') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">{{ __('messages.admin_panel') }}</h3>
                        <a href="{{ route('admin.login', app()->getLocale()) }}" 
                           class="text-blue-400 hover:text-blue-300">
                            {{ __('messages.admin_login') }}
                        </a>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ __('messages.books') }}. {{ __('messages.all_rights_reserved') ?? 'All rights reserved.' }}</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

