<?php

namespace Customer\Foundations\Subscription;

use App\Constants\SystemDefault;
use App\Models\Garage;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Customer\Http\Requests\Subscription\SubscriptionCreateRequest;

class SubscriptionCreateCollection
{
    public static function createSubscription(SubscriptionCreateRequest $request)
    {
        $validated  = $request->validated();

        $garage = Garage::find($validated['garage_id']);

        $validated['starts_at'] = Carbon::now();

        $validated['ends_at'] = Carbon::createFromDate($validated['starts_at'])->addMonths(1);

        $validated['amount'] = $garage && $garage->subscription_price ? $garage->subscription_price : SystemDefault::DEFAULT_SUBSCRIPTION_VALUE;

        $validated['auto_renew'] = true;

        $user = User::where('id', auth()->id())->first();

        Subscription::where('user_id', $user->id)->delete();

        $subscription = Subscription::create($validated);

        $new_balance = $user->current_balance - $validated['amount'];

        $user->update(['current_balance' => $new_balance]);

        return $subscription;
    }
}
