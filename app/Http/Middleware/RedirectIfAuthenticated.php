<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (app('request')->route()->getPrefix() == '/admin') {
                if (is_null(config('app.gameSn'))) {
                    \Auth::logout();
                    return redirect('admin/login');
                }

                return redirect('admin');
            }

            if (is_null(config('app.gameSn'))) {
                \Auth::logout();
                return redirect('login');
            }

            return redirect('/');
        }

        return $next($request);
    }
}
