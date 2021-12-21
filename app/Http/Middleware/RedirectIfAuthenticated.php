<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // echo "<pre>vvv"; print_r($guards); exit;
        // echo "<pre>vvv"; print_r($request->all()); exit;
        $guards = empty($guards) ? [null] : $guards;
         
        foreach ($guards as $guard) {
            // echo "<pre>vvv"; print_r($guard); exit;
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }
            if ($guard == "visitor" && Auth::guard($guard)->check()) {
                return redirect('/visitordashboard');
            }
            if ($guard == "user" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }
        }
         return $next($request);
    }
    // public function handle($request, Closure $next, $guard = null)
    //     {
    //         if ($guard == "visitor" && Auth::guard($guard)->check()) {
    //             return redirect('/visitordashboard');
    //         }
    //         if ($guard == "user" && Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //         if (Auth::guard($guard)->check()) {
    //             return redirect('/home');
    //         }

    //         return $next($request);
    //     }
}
