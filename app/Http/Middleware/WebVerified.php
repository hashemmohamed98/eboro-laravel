<?php

namespace App\Http\Middleware;

use App\Helper\UsersStatus;
use App\Mail\VerfiyMail;
use App\Services\ApiResponseService;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class WebVerified
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
        if ($request->user())
        {
            if ($request->user()->email_verified_at == null)
            {
                return redirect('verify');
            }
        }
        return $next($request);
    }
}
