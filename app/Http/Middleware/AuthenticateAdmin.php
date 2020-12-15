<?php

namespace App\Http\Middleware;

use Closure;



class AuthenticateAdmin
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


        if($request->user()->role != "admin")
        {
            return redirect()->to('/');
        }
        else
        {
        return $next($request);
        }

    }
}
