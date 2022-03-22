<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // //print_r($request->input('depot'));
        // if (Auth::guard($guard)->check()) {
        //     //Session::put('depot', $request->input("depot"));
        //     //$request->session()->put('depot','Virat Gandhi');
        //     session(['depot' => $request->input("depot")]);
        //     return redirect(RouteServiceProvider::HOME);
        // }
        // return $next($request);
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
