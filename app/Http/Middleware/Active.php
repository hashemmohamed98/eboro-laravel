<?php

namespace App\Http\Middleware;

use App\Helper\UsersStatus;
use App\Services\ApiResponseService;
use Closure;

class Active
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
        if(auth()->guard('api')->check()){
            if (auth()->user()->active==UsersStatus::InActive){

                auth()->logout();
                abort(422, "Account deletion error: The account has been deleted.");
                return (new ApiResponseService())->setError(trans('api.inactive_message'))
                    ->setCode(409)->send();
            }
        }
        if(auth()->guard('web')->check()){
            if (auth()->user()->active==UsersStatus::InActive){
                auth()->logout();
                abort(422, "Account deletion error: The account has been deleted.");
                return redirect(url('/'))->withErrors(trans('api.inactive_message'));
            }
        }
        return $next($request);
    }
}
