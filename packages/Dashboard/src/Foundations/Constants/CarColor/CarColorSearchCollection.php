<?php

namespace Dashboard\Foundations\Constants\CarColor;

use App\Constants\SystemDefault;

class CarColorSearchCollection
{
    public static function searchCarColors(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $carColors = CarColorQueryCollection::searchAllCarColors(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $carColors->paginate($per_page);
        } else {
            return $carColors->get();
        }

    }
}
