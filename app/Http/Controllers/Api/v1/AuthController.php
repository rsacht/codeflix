<?php

namespace CodeFlix\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use CodeFlix\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function sendLoginResponse(Request $request, $token){
        return ['token' => $token];
    }
}
