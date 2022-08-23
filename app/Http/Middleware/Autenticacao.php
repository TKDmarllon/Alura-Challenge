<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticacao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::attempt([
            'email' =>$request->header('email'),
            'password' =>$request->header('password')
        ])) {
            return $next($request);
        }

        if (!Auth::check()) {
            throw new AuthenticationException();  
        }

        // return $next($request);
    }
}
