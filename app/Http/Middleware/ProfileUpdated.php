<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ProfileUpdated
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
        if (Auth::user()->profile != null) {
            return $next($request);
        }
        return response()->json(['error' => 'Profile Not Complete'], 401);
    }
}
