@extends('layouts.app')

@section('title', __('messages.books'))

@section('content')

    <!-- Books Section -->
    <div class="py-16 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    {{ __('messages.books') }}
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    {{ __('messages.our_books') }}
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ __('messages.discover_amazing_books') }}
                </p>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <form method="GET" action="{{ route('books.index', $lang) }}" class="space-y-6">
                    <!-- Search Bar -->
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="{{ __('messages.search_books_placeholder') ?? 'Search by title, author, description, or category...' }}"
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            {{ __('messages.search') ?? 'Search' }}
                        </button>
                    </div>

                    <!-- Filters Row -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Category Filter -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.category') }}
                            </label>
                            <select name="category" id="category" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="">{{ __('messages.all_categories') ?? 'All Categories' }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->books_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Min Price Filter -->
                        <div>
                            <label for="min_price" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.min_price') ?? 'Min Price' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">$</span>
                                </div>
                                <input type="number" 
                                       name="min_price" 
                                       id="min_price"
                                       value="{{ request('min_price') }}"
                                       placeholder="0"
                                       min="0"
                                       step="0.01"
                                       class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <!-- Max Price Filter -->
                        <div>
                            <label for="max_price" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.max_price') ?? 'Max Price' }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">$</span>
                                </div>
                                <input type="number" 
                                       name="max_price" 
                                       id="max_price"
                                       value="{{ request('max_price') }}"
                                       placeholder="1000"
                                       min="0"
                                       step="0.01"
                                       class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <!-- Sort Filter -->
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.sort_by') ?? 'Sort By' }}
                            </label>
                            <select name="sort" id="sort" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('messages.latest') ?? 'Latest' }}</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>{{ __('messages.price_low_to_high') ?? 'Price: Low to High' }}</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>{{ __('messages.price_high_to_low') ?? 'Price: High to Low' }}</option>
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>{{ __('messages.title_a_z') ?? 'Title: A-Z' }}</option>
                                <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>{{ __('messages.author_a_z') ?? 'Author: A-Z' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                        <div class="flex justify-end">
                            <a href="{{ route('books.index', $lang) }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ __('messages.clear_filters') ?? 'Clear Filters' }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Results Summary -->
            @if(request()->hasAny(['search', 'category', 'min_price', 'max_price', 'sort']))
                <div class="mb-6">
                    <p class="text-gray-600">
                        {{ __('messages.showing_results') ?? 'Showing' }} 
                        <span class="font-semibold">{{ $books->count() }}</span> 
                        {{ __('messages.of') ?? 'of' }} 
                        <span class="font-semibold">{{ $books->total() }}</span> 
                        {{ __('messages.books') }}
                        @if(request('search'))
                            {{ __('messages.for') ?? 'for' }} "<span class="font-semibold">{{ request('search') }}</span>"
                        @endif
                    </p>
                </div>
            @endif

            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($books as $book)
                    <div class="group bg-white rounded-2xl shadow-lg hover-lift border border-gray-100 overflow-hidden">
                        <div class="aspect-w-3 aspect-h-4 bg-gray-200">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}"
                                     alt="{{ $book->title }}"
                                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $book->category->name }}
                                </span>
                                <span class="text-2xl font-bold text-green-600">${{ number_format($book->price, 2) }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $book->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $book->author }}</p>
                            <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ Str::limit($book->description, 100) }}</p>
                            <a href="{{ route('books.show', [$lang, $book]) }}"
                               class="inline-flex items-center w-full justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transition-all duration-200">
                                {{ __('messages.view_details') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('messages.no_books_found') }}</h3>
                        <p class="text-gray-600 mb-4">{{ __('messages.no_books_description') }}</p>
                        @if(request()->hasAny(['search', 'category', 'min_price', 'max_price']))
                            <a href="{{ route('books.index', $lang) }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                {{ __('messages.view_all_books') ?? 'View All Books' }}
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $books->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection