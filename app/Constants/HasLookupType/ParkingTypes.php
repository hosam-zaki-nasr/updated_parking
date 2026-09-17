<?php

namespace App\Constants\HasLookupType;

class ParkingTypes
{

    public const LOOKUP_TYPE = 5;

    public const VALET_PARKING = [
        'code' => 0,
        'prefix' => "VALET_PARKING",
        'name' => "Valet Parking",
        'name_ar' => "Valet Parking",
    ];

    public const VIP_PARKING = [
        'code' => 1,
        'prefix' => "VIP_RKING",
        'name' => "VIP Parking",
        'name_ar' => "VIP Parking",
    ];

    public const PER_HOUR = [
        'code' => 2,
        'prefix' => "PER_HOUR",
        'name' => "Per Hour",
        'name_ar' => "Per Hour",
    ];

    public const FINE_PARKING = [
        'code' => 3,
        'prefix' => "FINE_PARKING",
        'name' => "Fine Parking",
        'name_ar' => "Fine Parking",
    ];
}
