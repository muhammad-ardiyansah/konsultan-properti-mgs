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
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }

            if( Auth::guard($guard)->check() && Auth::user()->role == "ADMIN"){
                return redirect()->route('admin.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == "KONSULTAN"){
                return redirect()->route('konsultan.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == "DPD"){
                return redirect()->route('dpd.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == "DPP"){
                return redirect()->route('dpp.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == "DEVELOPER"){
                return redirect()->route('developer.listPengajuan');
            }                
            elseif( Auth::guard($guard)->check() && Auth::user()->role == "PENGAWAS"){
                return redirect()->route('pengawas.dashboard');
            }

        }

        return $next($request);
    }
}
