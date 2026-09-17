<?php

namespace Customer\Http\Middleware;


use App\Constants\StatusCode;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventIfAlreadySubscribedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $error_message = trans('general.already_has_active_subscription');

        $garage_id = $request->get('garage_id');

        $subscription = Subscription::where('user_id', auth()->id())->where('garage_id', $garage_id)->latest()->first();

        if (($subscription && $subscription->isEnded) or $subscription == null) {

            return $next($request);
        }

        return response()->error(
            $error_message,
            $error_message,
            StatusCode::NOT_ACCEPTABLE
        );
    }
}
