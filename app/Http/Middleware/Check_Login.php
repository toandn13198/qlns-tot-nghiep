<?php

namespace App\Http\Middleware;

use Closure;

class Check_Login
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
        if(!session()->has('user')){
             return redirect()->route('login.index');
        }else{ 
             return $next($request);
        }
       
    }
}
