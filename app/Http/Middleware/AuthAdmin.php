<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
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
        if(! $user = auth()->user()) {
            return redirect(route('login'));
        }

        return ! $user->isDefaultUser() ? $next($request) : abort(404);
    }
}
