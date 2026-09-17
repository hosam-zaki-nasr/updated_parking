<?php

namespace Dashboard\Foundations\Report;


use App\Constants\SystemDefault;

class SubscriptionSearchCollection
{
    public static function searchSubscriptionReports(
        $user_id = -1,
        $garage_id = -1,
        $starts_at = -1,
        $ends_at = -1,
        $is_active = -1,
        $deleted_at = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $subscriptions = SubscriptionQueryCollection::searchAllSubscriptionReports(
            $user_id,
            $garage_id,
            $starts_at,
            $ends_at,
            $is_active,
            $deleted_at,
        );

        if ($paginate && $paginate != -1) {

            return $subscriptions->paginate($per_page);
        } else {
            return $subscriptions->get();
        }
    }
}
