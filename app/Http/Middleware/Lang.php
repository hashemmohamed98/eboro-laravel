<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
class Lang
{

    public function handle($request, Closure $next)
    {
        if(session()->has('lang') && in_array(session('lang'), config('app.locales')))
        {
            App::setLocale(session()->get('lang'));
        }
        else
        {
            session()->put('lang', config('app.locale'));
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
