<?php

namespace Dashboard\Foundations\Country\Governorate;

use App\Constants\SystemDefault;
use App\Models\Country;

class GovernorateSearchCollection
{
    public static function searchCountryGovernorates(
        Country $country,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $governorates = GovernorateQueryCollection::searchCountryGovernorates(
            $country,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $governorates->paginate($per_page);
        } else {

            return $governorates->get();
        }
    }

    public static function searchAllGovernorates(
        $country_id,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $governorates = GovernorateQueryCollection::searchAllGovernorates(
            $country_id,
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $governorates->paginate($per_page);
        } else {

            return $governorates->get();
        }
    }
}
