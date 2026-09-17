<?php

namespace Dashboard\Foundations\Country\Governorate;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class GovernorateCreateCollection
{
    public static function createGovernorate($validated)
    {
        $validated['type'] = CountryType::GOVERNORATE['code'];

        return Country::create($validated);
    }
}
