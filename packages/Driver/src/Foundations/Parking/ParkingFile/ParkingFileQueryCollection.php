<?php

namespace Driver\Foundations\Parking\ParkingFile;

use App\Models\Parking;
use App\Models\ParkingFile;

class ParkingFileQueryCollection
{
    public static function searchAllParkingFiles(Parking $parking)
    {
        return ParkingFile::where('parking_id', $parking->id)

            ->orderBy('created_at', 'DESC');
    }
}
