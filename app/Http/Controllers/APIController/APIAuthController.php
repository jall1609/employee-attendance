<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AuthService;
use App\Http\Controllers\WebController\AuthController;
use App\Models\JobVacancy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIAuthController extends Controller
{
    protected $authService ;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
        $validator = Validator::make($request->all(), $this->authService->rules_login);

        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }
        $validatedData = $validator->validated();

        try {
            $token =  $this->authService->prosesLogin($request);
            if($token == false) return sendResponse(400, null, 'Wrong credentials');
        } catch (\Throwable $th) {
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }

        return $this->createNewToken($token);
    }

    public function logout(Request $request)
    {
        try {
             $this->authService->prosesLogout($request);
        } catch (\Throwable $th) {
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }

        return sendResponse(201, null, 'Logout success!');
    }
}
