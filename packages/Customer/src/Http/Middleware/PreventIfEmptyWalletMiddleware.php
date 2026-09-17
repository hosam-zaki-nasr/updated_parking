<?php

namespace Customer\Http\Middleware;

use App\Constants\HasLookupType\GarageTypes;
use App\Constants\StatusCode;
use App\Models\Garage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventIfEmptyWalletMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $error_message = trans('general.balance_not_enough');

        $garage = Garage::find($request->get('garage_id'));

        $current_balance = auth()->user()->current_balance;

        if ($garage) {

            if ($garage->type->code == GarageTypes::GARAGE_PARKING['code']) {

                if ($current_balance >= $garage->subscription_price) {

                    return $next($request);
                }
            } elseif ($garage->type->code == GarageTypes::VALET_PARKING['code']) {

                if ($current_balance >= $garage->valet_cost) {

                    return $next($request);
                }
            }
        }

        return response()->error(
            $error_message,
            $error_message,
            StatusCode::NOT_ACCEPTABLE
        );
    }
}
