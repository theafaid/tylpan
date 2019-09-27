<?php

namespace App\Http\Middleware;

use Closure;

class GuestAdmin
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
        if($user = auth()->user()) {
            return redirect(route('admin.dashboard'));
        }
        return $next($request);
    }
}
