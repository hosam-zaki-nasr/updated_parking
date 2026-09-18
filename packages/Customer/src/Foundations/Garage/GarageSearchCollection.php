<?php

namespace Customer\Foundations\Garage;

use App\Constants\SystemDefault;

class GarageSearchCollection
{
    public static function searchGarages(
        $radius = SystemDefault::DEFAULT_RADIUS_VALUE,
        $longitude = -1,
        $latitude = -1,
        $query_string = -1,
        $type_id = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $garages = GarageQueryCollection::searchAllGarages(
            $radius,
            $longitude,
            $latitude,
            $query_string,
            $type_id,
        );

        if ($paginate && $paginate != -1) {

            return $garages->paginate($per_page);
        } else {
            return $garages->get();
        }
    }

    public static function searchParkingGarages(
        $country_id = -1,
        $governorate_id = -1,
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $garages = GarageQueryCollection::searchAllParkingGarages(
            $country_id,
            $governorate_id,
            $query_string,
        );

        if ($paginate && $paginate != -1) {

            return $garages->paginate($per_page);
        } else {
            return $garages->get();
        }
    }
}
