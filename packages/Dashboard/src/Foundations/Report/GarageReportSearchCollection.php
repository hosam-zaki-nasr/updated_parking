<?php

namespace Dashboard\Foundations\Report;

use App\Constants\SystemDefault;

class GarageReportSearchCollection
{
    public static function searchAllGarageReports(
        $garage_id = -1,
        $type_id = -1,
        $status = -1,
        $starts_at = -1,
        $ends_at = -1,
        $period = -1,

        $car_type_id = -1,
        $car_number = -1,
        $customer_name = -1,
        $query_string = -1,

        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $garages = GarageReportQueryCollection::searchAllGarageReports(
            $garage_id,
            $type_id,
            $status,
            $starts_at,
            $ends_at,
            $period,

            $car_type_id,
            $car_number,
            $customer_name,
            $query_string,
        );

        if ($paginate && $paginate != -1) {

            return $garages->paginate($per_page);
        } else {
            return $garages->get();
        }
    }
}
