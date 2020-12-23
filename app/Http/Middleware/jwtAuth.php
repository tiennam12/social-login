<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class jwtAuth extends BaseMiddleware
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
        if(Cookie::has('social')==null) {
            $this->authenticate($request);
        }
        return $next($request);
    }
}
