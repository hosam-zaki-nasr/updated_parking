<?php

namespace App\Http\Middleware;

use App\Constants\StatusCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('api')->check()) {
            return $next($request);
        } else {

            return response()->error(
                trans('auth.plz_login'),
                trans('auth.plz_login'),
                StatusCode::UNAUTHORIZED
            );
        }
    }
}
