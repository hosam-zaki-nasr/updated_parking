<?php

namespace App\Constants\HasLookupType;

class RequestDriverStatus
{

    public const LOOKUP_TYPE = 7;

    public const PENDING = [
        'code' => 0,
        'key' => 0,
        'prefix' => "PENDING",
        'name' => "Pending",
        'name_ar' => "انتظار",
    ];

    public const ACCEPTED = [
        'code' => 1,
        'key' => 1,
        'prefix' => "ACCEPTED",
        'name' => "Accepted",
        'name_ar' => "مقبول",
    ];

    public const CANCELED = [
        'code' => 2,
        'key' => 2,
        'prefix' => "CANCELED",
        'name' => "Canceled",
        'name_ar' => "ملغي",
    ];

}
