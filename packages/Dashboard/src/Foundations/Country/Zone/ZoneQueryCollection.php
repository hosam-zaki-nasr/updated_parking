<?php

namespace Dashboard\Foundations\Country\Zone;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class ZoneQueryCollection
{
    public static function searchCountryZones(
        Country $country,
        $query_string = -1,
    ) {
        return Country::where('city_id', $country->id)

            ->where('type', CountryType::ZONE['code'])

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%')
                        ->orWhere('name_ar', 'like', '%' . $query_string . '%')
                        ->orWhere('prefix', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }

    public static function searchAllZones(
        $country_id,
        $query_string = -1,
    ) {
        return Country::where('type', CountryType::ZONE['code'])

            ->where(function ($q) use ($country_id, $query_string) {

                if ($country_id && $country_id != -1) {

                    return $q
                        ->where('country_id', $country_id);
                }
                if ($query_string && $query_string != -1) {

                    return $q
                        ->where('name', 'like', '%' . $query_string . '%')
                        ->orWhere('name_ar', 'like', '%' . $query_string . '%')
                        ->orWhere('prefix', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
