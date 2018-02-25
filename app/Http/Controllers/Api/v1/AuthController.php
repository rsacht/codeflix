<?php

namespace CodeFlix\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use CodeFlix\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;
}
