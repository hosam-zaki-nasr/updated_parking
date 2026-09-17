<?php

namespace Customer\Http\Middleware;


use App\Constants\HasLookupType\UserAccountType;
use App\Constants\StatusCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventIfContactMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $error_message = trans('general.permisstion_denied');

        if (auth()->user()->accountType->code == UserAccountType::CONTACT['code']) {

            return response()->error(
                $error_message,
                $error_message,
                StatusCode::NOT_ACCEPTABLE
            );
        }

        return $next($request);
    }
}
