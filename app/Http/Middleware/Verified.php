<?php

namespace App\Http\Middleware;

use App\Mail\VerfiyMail;
use App\Services\ApiResponseService;
use Closure;
use Illuminate\Support\Facades\Mail;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check())
        {
            if (auth()->user()->email_verified_at == null)
            {
                //Mail::to(auth()->user()->email)->send(new VerfiyMail(auth()->user()));
                return (new ApiResponseService())->setError(trans('api.verify_your_user'))->setCode(406)->send();
            }
        }
        return $next($request);
    }
}
