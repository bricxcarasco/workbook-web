<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guard($guard)->check()) {
            if (Auth::guard($guard)->user()->type == 1) {
                return redirect('/admin');
            } else if (Auth::guard($guard)->user()->type == 2) {
                return redirect('/provider');
            } else if (Auth::guard($guard)->user()->type == 3) {
                return redirect('/seeker');
            }
        }

        return $next($request);
    }
}
