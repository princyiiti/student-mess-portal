<?php

namespace App\Http\Middleware;
use Illuminate\Database\Eloquent\Model;
use Closure;
use Illuminate\Http\Response;

class StoreMiddleware
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
  //  print_r($request->user()->role);exit;
        if ($request->user() && $request->user()->role_id !=5)
{
return new Response(view('unauthorized')->with('role', 'ADMIN'));
}
//return $next($request);
        return $next($request);
    }
}
