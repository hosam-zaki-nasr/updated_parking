<?php

namespace Dashboard\Foundations\ValetDriver;

use App\Constants\SystemDefault;

class ValetDriverSearchCollection
{
    public static function searchValetDrivers(
        $garage_id = -1,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $valetDrivers = ValetDriverQueryCollection::searchAllValetDrivers(
            $garage_id,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $valetDrivers->paginate($per_page);
        } else {
            return $valetDrivers->get();
        }
    }
}
