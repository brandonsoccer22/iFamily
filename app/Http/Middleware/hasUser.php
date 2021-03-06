<?php

namespace App\Http\Middleware;

use Closure;

class hasUser
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
         if (!session()->has('user')) {
            return redirect('/home');
        }

        return $next($request);
    }
}
