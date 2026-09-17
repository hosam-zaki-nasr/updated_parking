<?php

namespace Customer\Foundations\Subscription;


use App\Constants\SystemDefault;

class SubscriptionSearchCollection
{
    public static function searchSubscriptions(
        $garage_id = -1,
        $starts_at = -1,
        $ends_at = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $subscriptions = SubscriptionQueryCollection::searchAllSubscriptions(
            $garage_id,
            $starts_at,
            $ends_at
        );

        if ($paginate && $paginate != -1) {

            return $subscriptions->paginate($per_page)->where('isEnded',false);
        } else {
            return $subscriptions->get()->where('isEnded',false);
        }
    }
}
