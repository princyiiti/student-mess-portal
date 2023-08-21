<?php

namespace App\Http\Middleware;

use Closure;

class FinanceMiddleware
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

        if ($request->user() && $request->user()->role_id !=4)
        {
            return new Response(view('unauthorized')->with('role', 'Finance'));
        }
            //return $next($request);   
        return $next($request);
    }
}
