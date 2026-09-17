<?php

namespace Dashboard\Foundations\Constants\CarType;

use App\Constants\SystemDefault;

class CarTypeSearchCollection
{
    public static function searchCarTypes(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $carTypes = CarTypeQueryCollection::searchAllCarTypes(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $carTypes->paginate($per_page);
        } else {
            return $carTypes->get();
        }
    }
}
