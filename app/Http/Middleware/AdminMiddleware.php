<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    public function handle($request, Closure $next)
    {
        if(Auth::user() && (Auth::user()->type == 1 || Auth::user()->type == 3 || Auth::user()->type == 4))
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
