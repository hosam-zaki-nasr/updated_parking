<?php

namespace Dashboard\Foundations\Country;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class CountryQueryCollection
{
    public static function searchAllCountries(
        $query_string = -1,
    ) {
        return Country::where('type', CountryType::COUNTRY['code'])

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
}
