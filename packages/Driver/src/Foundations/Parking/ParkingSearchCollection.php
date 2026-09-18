<?php

namespace Driver\Foundations\Parking;


use App\Constants\SystemDefault;

class ParkingSearchCollection
{
    public static function searchParkings(
        $status = -1,
        $starts_at = -1,
        $ends_at = -1,
        $period = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $parking = ParkingQueryCollection::searchAllParkings(
            $status,
            $starts_at,
            $ends_at,
            $period,
        );

        if ($paginate && $paginate != -1) {

            return $parking->paginate($per_page);
        } else {
            return $parking->get();
        }
    }
}
