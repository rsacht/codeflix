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

    public function accessToken(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if ($token = \Auth::guard('api')->attempt($credentials)) {
            //return resposta de sucesso para quem estiver consumindo!!
            return $this->sendLoginResponse($request,$token);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ],400);
    }

}
