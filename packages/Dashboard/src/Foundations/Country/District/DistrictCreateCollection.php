<?php

namespace Dashboard\Foundations\Country\District;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class DistrictCreateCollection
{
    public static function createDistrict($validated)
    {
        $validated['type'] = CountryType::DISTRICT['code'];

        return Country::create($validated);
    }
}
