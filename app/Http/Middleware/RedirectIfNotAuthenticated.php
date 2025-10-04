<?php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class RedirectIfNotAuthenticated extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $lang = $request->route('lang') ?? 'en';
            return route('admin.login', ['lang' => $lang]);
        }
    }
}
