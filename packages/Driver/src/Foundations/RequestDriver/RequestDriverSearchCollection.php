<?php

namespace Driver\Foundations\RequestDriver;

use App\Constants\SystemDefault;

class RequestDriverSearchCollection
{
    public static function searchRequestDrivers(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $requestDrivers = RequestDriverQueryCollection::searchAllRequestDrivers(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $requestDrivers->paginate($per_page);
        } else {
            return $requestDrivers->get();
        }
    }
}
