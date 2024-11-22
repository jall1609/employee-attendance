<?php

namespace App\Http\Controllers\ServiceController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends Controller
{
    public $rules_login ;

    public function __construct()
    {
        $this->rules_login = [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:5'
        ];
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        return $token = Auth::attempt($credentials);
    }

    public function prosesLogout()
    {
        Session::forget('api_token');
        session(['api_token' => 'asd']);
        return true;
    }
}
