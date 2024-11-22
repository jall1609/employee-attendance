<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function createNewToken($token)
    {
        $output = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => now()->addHours(2),
        ];
        $output['profile'] = auth()->user()->profile();

        return sendResponse(201, $output, 'Login success!');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:5'
        ]);

        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();
        $credentials = $request->only(['email', 'password']);

        try {
            $token = Auth::attempt($credentials);
            if($token == false) return sendResponse(400, null, 'Wrong credentials');
        } catch (\Throwable $th) {
            $return_api = [ 500, $th->getMessage(), 'Internal Server Error'];
            return sendResponse( ...$return_api );
        }

        return $this->createNewToken($token);
    }
}
