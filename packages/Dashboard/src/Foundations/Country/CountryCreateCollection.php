<?php

namespace Dashboard\Foundations\Country;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class CountryCreateCollection
{
    public static function createCountry($validated)
    {
        $validated['type'] = CountryType::COUNTRY['code'];

        return Country::create($validated);
    }
}
