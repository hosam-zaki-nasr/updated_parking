<?php

namespace Dashboard\Foundations\Report;

use App\Constants\SystemDefault;

class CustomerReportSearchCollection
{
    public static function searchAllCustomerReports(
        $query_string = -1,
        $country_id = -1,
        $governorate_id = -1,
        $date_from = -1,
        $date_to = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $customers = CustomerReportQueryCollection::searchAllCustomerReports(
            $query_string,
            $country_id,
            $governorate_id,
            $date_from,
            $date_to,
        );

        if ($paginate && $paginate != -1) {

            return $customers->paginate($per_page);
        } else {
            return $customers->get();
        }
    }
}
