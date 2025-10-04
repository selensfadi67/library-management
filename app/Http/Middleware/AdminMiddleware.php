<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            $lang = $request->route('lang', 'en');
            return redirect()->route('admin.login', $lang);
        }

        if (!auth()->user()->isAdmin()) {
            $lang = $request->route('lang', 'en');
            return redirect()->route('home', $lang)->with('error', __('messages.access_denied'));
        }

        return $next($request);
    }
}
