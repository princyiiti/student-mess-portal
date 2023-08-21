<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Response;

class StudentAffairs
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

        if ($request->user() && $request->user()->role_id !=3)
        {
            //dd('dsdd');
            //return new Response(view('')->with('role', 'studentaffairs'));
            return $next($request);
        }
            //return $next($request);   
        return $next($request);
    }
}
