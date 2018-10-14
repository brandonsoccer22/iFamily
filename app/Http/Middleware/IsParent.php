<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;

class IsParent
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
        $user = $request->user(); 
        //\Log::info("in middleware");

        if($user['is_parent']==true){
            //\Log::info("in middleware: pass");
            return $next($request);
        } else{
            //\Log::info("in middleware: fail");
            //return view('home')->with('user',$user);
            abort(403, 'Unauthorized action.');
        }
        
    }
}
