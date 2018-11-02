<?php

namespace App\Http\Middleware;

use Closure;

class mdAdminUser
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
        $currentUser=\Auth::user(); 
        if($currentUser->idProfile != 1){
            return view('oportuya.thankYouPage');
        }
        return $next($request);
    }
}
