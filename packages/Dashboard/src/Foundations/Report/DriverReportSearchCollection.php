<?php

namespace Dashboard\Foundations\Report;

use App\Constants\SystemDefault;

class DriverReportSearchCollection
{
    public static function searchAllDriverReports(
        $query_string = -1,
        $garage_id = -1,
        $country_id = -1,
        $governorate_id = -1,
        $date_from = -1,
        $date_to = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $drivers = DriverReportQueryCollection::searchAllDriverReports(
            $query_string,
            $garage_id,
            $country_id,
            $governorate_id,
            $date_from,
            $date_to,
        );

        if ($paginate && $paginate != -1) {

            return $drivers->paginate($per_page);
        } else {
            return $drivers->get();
        }
    }
}
