<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        foreach (auth()->user()->roles as $role) {
            if (in_array($role->id, $params)) {
                return $next($request);
            }
        }

        abort(403);
        // return $next($request);
    }
}
