<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Front\User;

class Identification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $targetUser = $request->route()->parameter('user');
        if ($targetUser->id !== auth()->user()->id) {
            abort(404);
        }

        return $next($request);
    }
}
