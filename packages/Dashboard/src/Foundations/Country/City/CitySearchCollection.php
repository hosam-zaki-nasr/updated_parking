<?php

namespace Dashboard\Foundations\Country\City;

use App\Constants\SystemDefault;
use App\Models\Country;

class CitySearchCollection
{
    public static function searchCountryCities(
        Country $country,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $cities = CityQueryCollection::searchCountryCities(
            $country,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $cities->paginate($per_page);
        } else {

            return $cities->get();
        }
    }

    public static function searchAllCities(
        $country_id,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $cities = CityQueryCollection::searchAllCities(
            $country_id,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $cities->paginate($per_page);
        } else {

            return $cities->get();
        }
    }
}
