<?php

namespace Dashboard\Foundations\Country\Governorate;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class GovernorateQueryCollection
{
    public static function searchCountryGovernorates(
        Country $country,
        $query_string = -1
    ) {
        return Country::where('country_id', $country->id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->whereHas('country')
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

    public static function searchAllGovernorates(
        $country_id,
        $query_string = -1
    ) {
        return Country::where('type', CountryType::GOVERNORATE['code'])
            ->where(function ($q) use ($country_id, $query_string) {

                if ($country_id && $country_id != -1) {

                    $q
                        ->where('country_id', $country_id);
                }
                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
