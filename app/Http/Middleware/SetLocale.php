<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);

        if (in_array($locale, Config::get('app.available_locales'))) {
            App::setLocale($locale);
        } else {
       
            $locale = Config::get('app.locale');

            return redirect($locale.'/'.$request->path());
        }

        return $next($request);
    }
}
