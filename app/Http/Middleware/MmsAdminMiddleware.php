<?php

namespace App\Http\Middleware;
use Illuminate\Database\Eloquent\Model;
use Closure;

class MmsAdminMiddleware
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
        //dd($request->user()->role);
        if ($request->user() && $request->user()->role_id != User::MMSU)
        {
        return new Response(view('unauthorized')->with('role', 'ADMIN'));
        }
        //return $next($request);
        return $next($request);
    }
}
