<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CajeroMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()){
            if(Auth::user()->load('role')->role->name == 'Cajero' || Auth::user()->load('role')->role->name == 'Administrador'){
                return $next($request);
            }

        }
        return redirect('/');
    }
}
