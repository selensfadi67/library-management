<!DOCTYPE html>
<html lang="{{ $lang }}" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.customer_login') ?? 'Customer Login' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-2">{{ __('messages.customer_login') ?? 'Customer Login' }}</h2>
        <p class="text-gray-600 text-center mb-6">{{ __('messages.customer_login_subtitle') ?? 'Sign in to your account to purchase books' }}</p>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.login', $lang) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('messages.email') }}:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required autofocus>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('messages.password') }}:</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-6 flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-600">{{ __('messages.remember_me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('messages.login') }}
                </button>
                <a href="{{ route('home', $lang) }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    {{ __('messages.back_home') }}
                </a>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                {{ __('messages.dont_have_account') ?? "Don't have an account?" }}
                <a href="{{ route('customer.register', $lang) }}" class="text-blue-500 hover:underline">
                    {{ __('messages.register_here') ?? 'Register here' }}
                </a>
            </p>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('customer.login', 'en') }}" class="text-blue-500 hover:underline mx-2">English</a>
            <a href="{{ route('customer.login', 'ar') }}" class="text-blue-500 hover:underline mx-2">العربية</a>
        </div>
    </div>
</body>
</html>
