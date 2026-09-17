<?php

namespace App\Constants\HasLookupType;

class GarageTypes
{

    public const LOOKUP_TYPE = 6;

    public const GARAGE_PARKING = [
        'code' => 1,
        'key' => 1,
        'prefix' => "GARAGE_PARKING",
        'name' => "Garage Parking",
        'name_ar' => "Garage Parking",
    ];

    public const VALET_PARKING = [
        'code' => 2,
        'key' => 2,
        'prefix' => "VALET_PARKING",
        'name' => "Valet Parking",
        'name_ar' => "Valet Parking",
    ];

    public const GARAGE_AND_VALET_PARKING = [
        'code' => 3,
        'key' => 3,
        'prefix' => "GARAGE_AND_VALET_PARKING",
        'name' => "Garage And Valet Parking",
        'name_ar' => "Garage And Valet Parking",
    ];
}
