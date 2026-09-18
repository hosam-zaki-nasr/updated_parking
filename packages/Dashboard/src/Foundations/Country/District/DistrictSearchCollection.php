<?php

namespace Dashboard\Foundations\Country\District;

use App\Constants\SystemDefault;
use App\Models\Country;

class DistrictSearchCollection
{
    public static function searchCountryDistricts(
        Country $country,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $districts = DistrictQueryCollection::searchCountryDistricts(
            $country,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $districts->paginate($per_page);
        } else {

            return $districts->get();
        }
    }

    public static function searchAllDistricts(
        $country_id,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $districts = DistrictQueryCollection::searchAllDistricts(
            $country_id,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $districts->paginate($per_page);
        } else {

            return $districts->get();
        }
    }
}
