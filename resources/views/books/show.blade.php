@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Book Image -->
            <div class="space-y-6">
                @if($book->image)
                    <div class="aspect-w-3 aspect-h-4 rounded-lg overflow-hidden">
                        <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}"
                             class="w-full h-full object-cover rounded-lg shadow-lg">
                    </div>
                @else
                    <div class="aspect-w-3 aspect-h-4 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Book Details -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-600 mb-4"> {{ $book->author }}</p>

                    <div class="flex items-center space-x-4 mb-6">
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                            {{ $book->category->name }}
                        </span>
                        @if($book->release_date)
                            <span class="text-sm text-gray-500">
                                <i class="la la-calendar mr-1"></i>
                                {{ __('messages.released') ?? 'Released' }}: {{ $book->release_date->format('M d, Y') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Price -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('messages.price') }}</h3>
                            <p class="text-3xl font-bold text-blue-600">${{ number_format($book->price, 2) }}</p>
                        </div>
                        @auth
                            <div class="text-right">
                                <p class="text-sm text-gray-500">{{ __('messages.your_balance') ?? 'Your Balance' }}</p>
                                <p class="text-lg font-semibold text-green-600">${{ number_format(auth()->user()->balance, 2) }}</p>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('messages.description') ?? 'Description' }}</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
                </div>

                <!-- Purchase Section -->
                <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    @auth
                        @php
                            $user = auth()->user();
                            $hasEnoughBalance = $user->balance >= $book->price;
                            $alreadyPurchased = $user->purchases()->where('book_id', $book->id)->exists();
                        @endphp

                        @if($alreadyPurchased)
                            <div class="text-center">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 text-green-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-green-600 mb-2">{{ __('messages.already_purchased') ?? 'Already Purchased' }}</h3>
                                    <p class="text-gray-600">{{ __('messages.you_own_this_book') ?? 'You already own this book!' }}</p>
                                </div>
                                <a href="{{ route('customer.login', app()->getLocale()) }}"
                                   class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="la la-download mr-2"></i>
                                    {{ __('messages.download_book') ?? 'Download Book' }}
                                </a>
                            </div>
                        @elseif($hasEnoughBalance)
                            <form action="{{ route('purchase.store', [app()->getLocale(), $book]) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('messages.ready_to_purchase') ?? 'Ready to Purchase?' }}</h3>
                                    <p class="text-gray-600 mb-4">{{ __('messages.purchase_confirmation') ?? 'Click the button below to purchase this book. The amount will be deducted from your balance and you will receive an email with the book.' }}</p>

                                    <div class="bg-blue-50 rounded-lg p-4 mb-4">
                                        <div class="flex justify-between items-center text-sm">
                                            <span>{{ __('messages.book_price') ?? 'Book Price' }}:</span>
                                            <span class="font-semibold">${{ number_format($book->price, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm mt-1">
                                            <span>{{ __('messages.your_balance') ?? 'Your Balance' }}:</span>
                                            <span class="font-semibold text-green-600">${{ number_format($user->balance, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm mt-1 border-t pt-1">
                                            <span>{{ __('messages.remaining_balance') ?? 'Remaining Balance' }}:</span>
                                            <span class="font-semibold text-blue-600">${{ number_format($user->balance - $book->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                        class="w-full bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold transition-colors flex items-center justify-center">
                                    <i class="la la-shopping-cart mr-2"></i>
                                    {{ __('messages.buy_now') ?? 'Buy Now' }} - ${{ number_format($book->price, 2) }}
                                </button>
                            </form>
                        @else
                            <div class="text-center">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-red-600 mb-2">{{ __('messages.insufficient_balance') ?? 'Insufficient Balance' }}</h3>
                                    <p class="text-gray-600 mb-4">{{ __('messages.insufficient_balance_message') ?? 'You do not have enough balance to purchase this book.' }}</p>

                                    <div class="bg-red-50 rounded-lg p-4 mb-4">
                                        <div class="flex justify-between items-center text-sm">
                                            <span>{{ __('messages.book_price') ?? 'Book Price' }}:</span>
                                            <span class="font-semibold">${{ number_format($book->price, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm mt-1">
                                            <span>{{ __('messages.your_balance') ?? 'Your Balance' }}:</span>
                                            <span class="font-semibold text-red-600">${{ number_format($user->balance, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between items-center text-sm mt-1 border-t pt-1">
                                            <span>{{ __('messages.needed') ?? 'Needed' }}:</span>
                                            <span class="font-semibold text-red-600">${{ number_format($book->price - $user->balance, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('customer.login', app()->getLocale()) }}"
                                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                                    <i class="la la-wallet mr-2"></i>
                                    {{ __('messages.add_balance') ?? 'Add Balance' }}
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-blue-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('messages.login_required') ?? 'Login Required' }}</h3>
                                <p class="text-gray-600 mb-4">{{ __('messages.login_to_purchase') ?? 'Please login to purchase this book.' }}</p>
                            </div>
                            <a href="{{ route('customer.login', app()->getLocale()) }}"
                               class="w-full bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold transition-colors flex items-center justify-center">
                                {{ __('messages.login') }} {{ __('messages.to_purchase') ?? 'to Purchase' }}
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->count() > 0)
            <div class="mt-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">{{ __('messages.related_books') ?? 'Related Books' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedBooks as $relatedBook)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            @if($relatedBook->image)
                                <img src="{{ Storage::url($relatedBook->image) }}" alt="{{ $relatedBook->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $relatedBook->title }}</h3>
                                <p class="text-gray-600 text-sm mb-3"> {{ $relatedBook->author }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xl font-bold text-blue-600">${{ number_format($relatedBook->price, 2) }}</span>
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">{{ $relatedBook->category->name }}</span>
                                </div>
                                <a href="{{ route('books.show', [app()->getLocale(), $relatedBook]) }}"
                                   class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    {{ __('messages.view_details') ?? 'View Details' }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
