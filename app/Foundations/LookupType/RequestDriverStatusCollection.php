<?php

namespace App\Foundations\LookupType;

use App\Constants\HasLookupType\RequestDriverStatus;
use App\Models\SystemLookup;

class RequestDriverStatusCollection

{
    public static function typeList()
    {
        return SystemLookup::where('type', RequestDriverStatus::LOOKUP_TYPE)
            ->get();
    }

    public static function pending()
    {
        return SystemLookup::where('type', RequestDriverStatus::LOOKUP_TYPE)
            ->where('code',  RequestDriverStatus::PENDING['code'])
            ->first();
    }

    public static function accepted()
    {
        return SystemLookup::where('type', RequestDriverStatus::LOOKUP_TYPE)
            ->where('code',  RequestDriverStatus::ACCEPTED['code'])
            ->first();
    }

    public static function canceled()
    {
        return SystemLookup::where('type', RequestDriverStatus::LOOKUP_TYPE)
            ->where('code',  RequestDriverStatus::CANCELED['code'])
            ->first();
    }
}
