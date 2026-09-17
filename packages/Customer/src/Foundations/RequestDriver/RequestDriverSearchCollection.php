<?php

namespace Customer\Foundations\RequestDriver;

use App\Constants\SystemDefault;

class RequestDriverSearchCollection
{
    public static function searchRequestDrivers(
        $status_id = -1,
        $driver_id = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $requestDrivers = RequestDriverQueryCollection::searchAllRequestDrivers(
            $status_id,
            $driver_id
        );

        if ($paginate && $paginate != -1) {

            return $requestDrivers->paginate($per_page);
        } else {
            return $requestDrivers->get();
        }
    }
}
