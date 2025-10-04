<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm(string $lang)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard', $lang);
        }

        return view('admin.auth.login', compact('lang'));
    }

    /**
     * Handle admin login
     */
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

            if ($user->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard', $lang));
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => [__('messages.access_denied')],
                ]);
            }
        }

        throw ValidationException::withMessages([
            'email' => [__('messages.invalid_credentials')],
        ]);
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request, string $lang)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login', $lang);
    }
}
