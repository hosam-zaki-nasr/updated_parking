<?php

namespace Customer\Http\Middleware;


use App\Constants\StatusCode;
use App\Models\Car;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventIfCarsEqualsThreeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $error_message = trans('general.you_cant_not_create_more_than_three_cars');

        $cars_count = Car::where('creator_id', auth()->id())->count();

        if ($cars_count >= 3) {

            return response()->error(
                $error_message,
                $error_message,
                StatusCode::NOT_ACCEPTABLE
            );
        }

        return $next($request);
    }
}
