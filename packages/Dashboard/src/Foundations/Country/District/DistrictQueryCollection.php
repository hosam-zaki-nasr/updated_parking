<?php

namespace Dashboard\Foundations\Country\District;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class DistrictQueryCollection
{
    public static function searchCountryDistricts(
        Country $country,
        $query_string = -1,
    ) {
        return Country::where('zone_id', $country->id)

            ->where('type', CountryType::DISTRICT['code'])

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



    public static function searchAllDistricts(
        $country_id,
        $query_string = -1,
    ) {
        return Country::where('type', CountryType::DISTRICT['code'])

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
