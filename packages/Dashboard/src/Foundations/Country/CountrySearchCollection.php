<?php

namespace Dashboard\Foundations\Country;

use App\Constants\SystemDefault;

class CountrySearchCollection
{
    public static function searchCountries(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = CountryQueryCollection::searchAllCountries($query_string);

        if ($paginate && $paginate != -1) {

            return $countries->paginate($per_page);
        } else {

            return $countries->get();
        }
    }
}
