<?php

namespace App\Http\Middleware;

use Closure;

class IsRegistration
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
        foreach (auth()->user()->roles as $role) {
            if (in_array($role->id, [1, 3])) {
                return $next($request);
            }
        }

        abort(403);
    }
}
