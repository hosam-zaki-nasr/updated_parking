<?php

namespace App\Foundations\LookupType;

use App\Constants\HasLookupType\GarageTypes;
use App\Models\SystemLookup;

class GarageTypeCollection

{
    public static function typeList()
    {
        return SystemLookup::where('type', GarageTypes::LOOKUP_TYPE)
            ->get();
    }

    public static function garage()
    {
        return SystemLookup::where('type', GarageTypes::LOOKUP_TYPE)
            ->where('code',  GarageTypes::GARAGE_PARKING['code'])
            ->first();
    }

    public static function valet()
    {
        return SystemLookup::where('type', GarageTypes::LOOKUP_TYPE)
            ->where('code',  GarageTypes::VALET_PARKING['code'])
            ->first();
    }
}
