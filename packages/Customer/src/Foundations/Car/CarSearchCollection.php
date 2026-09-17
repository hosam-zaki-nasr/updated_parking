<?php

namespace Customer\Foundations\Car;


use App\Constants\SystemDefault;

class CarSearchCollection
{
    public static function searchCars(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $cars = CarQueryCollection::searchAllCars(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $cars->paginate($per_page);
        } else {
            return $cars->get();
        }
    }
}
