<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    
    public function showLoginForm(string $lang)
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            return redirect()->route('home', $lang);
        }
        return view('auth.customer.login', compact('lang'));
    }

    public function login(Request $request, string $lang)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if (!$user->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended(route('home', $lang));
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => [__('messages.admin_access_denied')],
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => [__('messages.invalid_credentials')],
        ]);
    }

  
    public function showRegisterForm(string $lang)
    {
        if (Auth::check() && !Auth::user()->isAdmin()) {
            return redirect()->route('home', $lang);
        }
        return view('auth.customer.register', compact('lang'));
    }

    public function register(Request $request, string $lang)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('home', $lang)
            ->with('success', __('messages.registration_successful'));
    }

    public function logout(Request $request, string $lang)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home', $lang);
    }
}
