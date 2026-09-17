<?php

namespace Dashboard\Foundations\Garage;

use App\Constants\SystemDefault;

class GarageSearchCollection
{
    public static function searchGarages(
        $country_id = -1,
        $governorate_id = -1,
        $type_id = -1,
        $query_string = -1,
        $site_number = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $garages = GarageQueryCollection::searchAllGarages(
            $country_id,
            $governorate_id,
            $type_id,
            $query_string,
            $site_number,
        );

        if ($paginate && $paginate != -1) {

            return $garages->paginate($per_page);
        } else {
            return $garages->get();
        }
    }
}
