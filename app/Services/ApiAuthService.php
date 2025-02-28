<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth\Exceptions\JWTException;

class ApiAuthService
{
    function login($input)
    {
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return false;
        }
        return $jwt_token;
    }

    function getAuthUser($token)
    {
        $user = Auth::user();
        return $user;
    }

    function getUserToken($user)
    {
        return JWTAuth::fromUser($user);
    }

}
