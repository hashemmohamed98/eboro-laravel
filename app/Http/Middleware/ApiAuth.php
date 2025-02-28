<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuth extends Middleware
{

    public function handle($request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'message' => trans('api.unauthorized'),
                    'status' => 'error'
                ], 401);

            }
            return $next($request);

        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => trans('api.unauthorized'),
                'status' => 'error'
            ], 401);
        }

    }
}
