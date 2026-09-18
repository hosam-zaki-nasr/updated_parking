<?php

namespace Driver\Foundations\Parking\ParkingFile;


use App\Constants\SystemDefault;
use App\Models\Parking;

class ParkingFileSearchCollection
{
    public static function searchParkingFiles(
        Parking $parking,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $parking = ParkingFileQueryCollection::searchAllParkingFiles($parking);

        if ($paginate && $paginate != -1) {

            return $parking->paginate($per_page);
        } else {
            return $parking->get();
        }
    }
}
