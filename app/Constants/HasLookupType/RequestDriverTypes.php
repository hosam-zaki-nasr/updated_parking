<?php

namespace App\Constants\HasLookupType;

class RequestDriverTypes
{

    public const LOOKUP_TYPE = 8;

    public const START_PARKING = [
        'code' => 0,
        'key' => 0,
        'prefix' => "START_PARKING",
        'name' => "Start Parking",
        'name_ar' => "بداية",
    ];

    public const END_PARKING = [
        'code' => 1,
        'key' => 1,
        'prefix' => "END_PARKING",
        'name' => "End Parking",
        'name_ar' => "انهاء",
    ];
}
