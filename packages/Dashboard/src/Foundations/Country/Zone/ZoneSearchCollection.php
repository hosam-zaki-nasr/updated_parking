<?php

namespace Dashboard\Foundations\Country\Zone;

use App\Constants\SystemDefault;
use App\Models\Country;

class ZoneSearchCollection
{
    public static function searchCountryZones(
        Country $country,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $zones = ZoneQueryCollection::searchCountryZones(
            $country,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $zones->paginate($per_page);
        } else {

            return $zones->get();
        }
    }

    public static function searchAllZones(
        $country_id,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $zones = ZoneQueryCollection::searchAllZones(
            $country_id,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $zones->paginate($per_page);
        } else {

            return $zones->get();
        }
    }
}
