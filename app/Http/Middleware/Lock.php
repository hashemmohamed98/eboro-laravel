<?php

namespace App\Http\Middleware;
use Closure;
use App\Http\Controllers\SiteController;
use App\Setting;
class Lock
{

    public function handle($request, Closure $next)
    {
        if(Setting::first()->state=='close')
        {
            return response()->view('site.error.lock', SiteController::GData());
        }
        else
        {
            return $next($request);
        }
    }
}
