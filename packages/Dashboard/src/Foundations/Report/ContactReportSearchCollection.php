<?php

namespace Dashboard\Foundations\Report;

use App\Constants\SystemDefault;

class ContactReportSearchCollection
{
    public static function searchAllContactReports(
        $customer_id = -1,
        $query_string = -1,
        $country_id = -1,
        $governorate_id = -1,
        $date_from = -1,
        $date_to = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $contacts = ContactReportQueryCollection::searchAllContactReports(
            $customer_id,
            $query_string,
            $country_id,
            $governorate_id,
            $date_from,
            $date_to,
        );

        if ($paginate && $paginate != -1) {

            return $contacts->paginate($per_page);
        } else {
            return $contacts->get();
        }
    }
}
