<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ServiceController\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( (auth()->user()->employee->user->status ?? null) == 'active') {
            return $next($request);
        }
        (new AuthService())->prosesLogout();
        return redirect('/')->with('status', 'error')->with('message', 'Akun anda tidak aktif, silahkan hubungi admin');
    }
}
