<?php

namespace App\Http\Middleware;

use Closure;

class ProfileCompleted
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
        if(! auth()->user()->profile->hasCompleted) {
            session()->flash('uncompletedProfile', 'Please Complete Your Profile Data First.');
            return redirect()->route('profile.index');
        }

        return $next($request);
    }
}
