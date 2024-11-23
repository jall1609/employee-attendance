<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('api_token');
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return redirect(url('/admin/login'))->with('status', 'error')->with('message','Login dulu' ) ;
            } else if ($e instanceof TokenExpiredException) {
                return redirect(url('/admin/login'))->with('status', 'error')->with('message','Sesi Habis, silahkan login lagi' ) ;
            }
            return redirect(url('/admin/login'))->with('status', 'error')->with('message','Login dulu' ) ;
        }
        return $next($request);
    }
}
