<?php

namespace Customer\Foundations\Subscription;

use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionQueryCollection
{
    public static function searchAllSubscriptions(
        $garage_id = -1,
        $starts_at = -1,
        $ends_at = -1,
    ) {
        return Subscription::where('user_id', auth()->id())

            ->where(function ($q) use ($garage_id, $starts_at, $ends_at) {

                if ($garage_id && $garage_id != -1) {

                    $q
                        ->where('garage_id', $garage_id);
                }

                if ($starts_at && $starts_at != -1 && $ends_at && $ends_at != -1) {
                    $q
                        ->whereBetween('starts_at', [
                            Carbon::create($starts_at),
                            Carbon::create($ends_at)->endOfDay()
                        ])
                        ->whereBetween('ends_at', [
                            Carbon::create($starts_at),
                            Carbon::create($ends_at)->endOfDay()
                        ]);
                } else if ($starts_at && $starts_at != -1) {

                    $q
                        ->whereBetween('starts_at', [
                            Carbon::create($starts_at)->startOfDay(),
                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($ends_at && $ends_at != -1) {

                    $q
                        ->whereBetween('ends_at', [
                            Carbon::create(1900, 01, 01),
                            Carbon::create($ends_at)->endOfDay()
                        ]);
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
