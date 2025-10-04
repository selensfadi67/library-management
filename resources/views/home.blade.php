@extends('layouts.app')

@section('title', __('messages.home_title'))

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">
            {{ __('messages.welcome_home') }}
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
            {{ __('messages.discover_amazing_books') ?? 'Discover amazing books from our digital library' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('books.index', app()->getLocale()) }}"
               class="inline-flex items-center bg-white text-blue-600 hover:bg-gray-50 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                {{ __('messages.browse_books') ?? 'Browse Books' }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            @guest
                <a href="{{ route('customer.register', app()->getLocale()) }}"
                   class="inline-flex items-center bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    {{ __('messages.get_started') ?? 'Get Started' }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </a>
            @endguest
        </div>
    </div>
</div>

<!-- About Us Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ __('messages.about_us') ?? 'About Us' }}
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                {{ __('messages.about_us_description') ?? 'We are passionate about bringing you the best digital reading experience with our extensive collection of e-books.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    {{ __('messages.extensive_collection') ?? 'Extensive Collection' }}
                </h3>
                <p class="text-gray-600">
                    {{ __('messages.extensive_collection_desc') ?? 'Thousands of books across various genres and categories.' }}
                </p>
            </div>

            <div class="text-center">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    {{ __('messages.instant_access') ?? 'Instant Access' }}
                </h3>
                <p class="text-gray-600">
                    {{ __('messages.instant_access_desc') ?? 'Download and read your books immediately after purchase.' }}
                </p>
            </div>

            <div class="text-center">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    {{ __('messages.affordable_prices') ?? 'Affordable Prices' }}
                </h3>
                <p class="text-gray-600">
                    {{ __('messages.affordable_prices_desc') ?? 'Great books at competitive prices for everyone.' }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Latest Books Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ __('messages.latest_books') }}
            </h2>
            <p class="text-lg text-gray-600">
                {{ __('messages.discover_our_latest') ?? 'Discover our latest additions to the library' }}
            </p>
        </div>

        @if($latestBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($latestBooks as $book)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $book->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $book->author }}</p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-blue-600">${{ number_format($book->price, 2) }}</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">{{ $book->category->name }}</span>
                            </div>
                            <a href="{{ route('books.show', [app()->getLocale(), $book]) }}"
                               class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">{{ __('messages.no_books_available') }}</p>
            </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('books.index', app()->getLocale()) }}"
               class="inline-flex items-center bg-gray-200 text-gray-800 hover:bg-gray-300 px-6 py-3 rounded-lg text-lg font-semibold transition-colors">
                {{ __('messages.view_all_books') }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Top Purchased Books Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ __('messages.top_purchased_books') ?? 'Most Popular Books' }}
            </h2>
            <p class="text-lg text-gray-600">
                {{ __('messages.best_sellers') ?? 'Check out our best-selling books' }}
            </p>
        </div>

        @if($topPurchasedBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($topPurchasedBooks as $book)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow relative">
                        @if($book->purchases_count > 0)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                                🔥 {{ $book->purchases_count }} {{ __('messages.sold') ?? 'sold' }}
                            </div>
                        @endif

                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $book->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3"> {{ $book->author }}</p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-green-600">${{ number_format($book->price, 2) }}</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">{{ $book->category->name }}</span>
                            </div>
                            <a href="{{ route('books.show', [app()->getLocale(), $book]) }}"
                               class="block w-full text-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500 text-lg">{{ __('messages.no_purchases_yet') ?? 'No purchases yet' }}</p>
            </div>
        @endif
    </div>
</div>

<!-- Call to Action Section -->
<div class="py-16 bg-gradient-to-r from-purple-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">
            {{ __('messages.ready_to_start') ?? 'Ready to Start Reading?' }}
        </h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            {{ __('messages.join_thousands') ?? 'Join thousands of readers who have already discovered their next favorite book.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('books.index', app()->getLocale()) }}"
               class="inline-flex items-center bg-white text-purple-600 hover:bg-gray-50 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                {{ __('messages.browse_books') ?? 'Browse Books' }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            @guest
                <a href="{{ route('customer.register', app()->getLocale()) }}"
                   class="inline-flex items-center bg-transparent border-2 border-white text-white hover:bg-white hover:text-purple-600 px-8 py-3 rounded-lg text-lg font-semibold transition-colors">
                    {{ __('messages.create_account') ?? 'Create Account' }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </a>
            @endguest
        </div>
    </div>
</div>
@endsection
