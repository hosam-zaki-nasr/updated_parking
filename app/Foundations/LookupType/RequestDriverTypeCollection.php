<?php

namespace App\Foundations\LookupType;

use App\Constants\HasLookupType\RequestDriverTypes;
use App\Models\SystemLookup;

class RequestDriverTypeCollection

{
    public static function typeList()
    {
        return SystemLookup::where('type', RequestDriverTypes::LOOKUP_TYPE)
            ->get();
    }

    public static function startParking()
    {
        return SystemLookup::where('type', RequestDriverTypes::LOOKUP_TYPE)
            ->where('code',  RequestDriverTypes::START_PARKING['code'])
            ->first();
    }

    public static function endParking()
    {
        return SystemLookup::where('type', RequestDriverTypes::LOOKUP_TYPE)
            ->where('code',  RequestDriverTypes::END_PARKING['code'])
            ->first();
    }

}
