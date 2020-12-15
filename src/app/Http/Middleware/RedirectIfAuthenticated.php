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

        $routeNames = [
            'user' => 'top',
            'operator' => 'back.top',
        ];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $routeName = (isset($routeNames[$guard])) ? $routeNames[$guard] : 'top';

                return redirect(route($routeName));
            }
        }

        return $next($request);
    }
}
