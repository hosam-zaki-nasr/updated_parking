<?php

namespace Dashboard\Foundations\Report;

use App\Constants\SystemDefault;

class CarReportSearchCollection
{
    public static function searchAllCarReports(
        $customer_id = -1,
        $query_string = -1,
        $full_number = -1,
        $date_from = -1,
        $date_to = -1,
        $car_color_id = -1,
        $car_type_id = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $cars = CarReportQueryCollection::searchAllCarReports(
            $customer_id,
            $query_string,
            $full_number,
            $date_from,
            $date_to,
            $car_color_id,
            $car_type_id,
        );

        if ($paginate && $paginate != -1) {

            return $cars->paginate($per_page);
        } else {
            return $cars->get();
        }
    }
}
