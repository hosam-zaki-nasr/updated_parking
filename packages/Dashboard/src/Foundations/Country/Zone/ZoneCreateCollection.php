<?php

namespace Dashboard\Foundations\Country\Zone;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class ZoneCreateCollection
{
    public static function createZone($validated)
    {
        $validated['type'] = CountryType::ZONE['code'];

        return Country::create($validated);
    }
}
