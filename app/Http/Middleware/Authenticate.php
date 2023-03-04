<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

// class Authenticate extends Middleware
// {
//     protected function redirectTo($request)
//     {
//         if (! $request->expectsJson()) {
//             return route('login');
//         }
//     }
// }


use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    { 
        $guards = empty($guards) ? ['client_admin'] : $guards;

        if (Auth::guard('client_admin')->check()) {
            return $next($request);
        }else if(Auth::guard('manager')->check()){
            return $next($request);
        }else {
            return redirect('login');
        }


        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return $next($request);
        //         // return redirect(RouteServiceProvider::HOME);
        //     } else {
        //         return redirect('login');
        //     }
        // }
        
        return redirect('login');
        // return $next($request);
    }
}