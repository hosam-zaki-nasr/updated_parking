<?php

namespace Dashboard\Foundations\Constants\ChargePrice;

use App\Models\ChargePrice;

class ChargePriceQueryCollection
{
    public static function searchAllChargePrices()
    {

        return ChargePrice::orderBy('created_at', 'DESC');
    }
}
