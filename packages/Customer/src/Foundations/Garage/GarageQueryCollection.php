<?php

namespace Customer\Foundations\Garage;

use App\Constants\HasLookupType\GarageTypes;
use App\Models\Garage;
use App\Models\SystemLookup;

class GarageQueryCollection
{
    public static function searchAllGarages(
        $radius = -1,
        $longitude = -1,
        $latitude = -1,
        $query_string = -1,
        $type_id = -1
    ) {
        return Garage::selectRaw("*,
        ( 6371000 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
          * cos( radians( longitude ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( latitude ) ) )
        ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", $radius * 10000000000000)

            ->where(function ($q) use ($query_string, $type_id) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }

                if ($type_id && $type_id != -1) {

                    $q
                        ->where('type_id', $type_id);
                }
            })
            ->orderBy("distance", 'asc');
    }

    public static function searchAllParkingGarages(
        $country_id = -1,
        $governorate_id = -1,
        $query_string = -1,
    ) {

        $garage_parking_type = SystemLookup::where('type', GarageTypes::LOOKUP_TYPE)

            ->where('code', GarageTypes::GARAGE_PARKING['code'])

            ->first();

        return Garage::where('type_id', $garage_parking_type->id)

            ->where(function ($q) use ($country_id, $governorate_id, $query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }

                if ($country_id && $country_id != -1) {

                    $q
                        ->where('country_id', $country_id);
                }

                if ($governorate_id && $governorate_id != -1) {

                    $q
                        ->where('governorate_id', $governorate_id);
                }
            })
            ->orderBy("created_at", 'asc');
    }
}
