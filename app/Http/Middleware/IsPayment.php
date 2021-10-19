<?php

namespace App\Http\Middleware;

use Closure;

class IsPayment
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
            if (in_array($role->id, [1, 4])) {
                return $next($request);
            }
        }

        abort(403);
    }
}
