<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AuthService;
use App\Models\JobVacancy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $authService ;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request = $request->validate($this->authService->rules_login);
        $request = new Request($request);

        try {
            $token = $this->authService->prosesLogin($request);
        } catch (\Throwable $th) {
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }

        if ( ($token ?? false) == false) return redirect()->back()->with('status', 'error')->with('message', 'Email atau password salah');

        session(['api_token' => $token]);
        if(auth()->user()->hasRole('admin')) $redirect_to = 'dashboard';
        elseif(auth()->user()->hasRole('employee')) $redirect_to = 'employee.absensi';

        return redirect()->route($redirect_to)->with('status', 'success')->with('message', 'Login successful!');
    }

    public function logout(Request $request)
    {
        try {
            $q =  $this->authService->prosesLogout($request);
        } catch (\Throwable $th) {
            redirect()->back()->with('status', 'error')->with('message', $th->getMessage());
        }
        $token = session('api_token');
        
        return redirect('/')->with('status', 'success')->with('message', 'Berhasil Logout');
    }

}
