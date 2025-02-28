<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ApiLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $default = config('app.locale');
        if (isset( $_SERVER['HTTP_APILANG'])){
            if (in_array($_SERVER['HTTP_APILANG'],config('app.locales'))){
                $default = $_SERVER['HTTP_APILANG'];
            }
        }
        App::setLocale($default);
        return $next($request);
    }
}
