<?php

namespace Dashboard\Foundations\Country\City;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class CityCreateCollection
{
    public static function createCity($validated)
    {
        $validated['type'] = CountryType::CITY['code'];

        return Country::create($validated);
    }
}
