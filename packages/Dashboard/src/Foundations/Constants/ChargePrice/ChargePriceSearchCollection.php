<?php

namespace Dashboard\Foundations\Constants\ChargePrice;

use App\Constants\SystemDefault;

class ChargePriceSearchCollection
{
    public static function searchChargePrices(
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    )
    {

        $chargePrices = ChargePriceQueryCollection::searchAllChargePrices();

        if ($paginate && $paginate != -1) {

            return $chargePrices->paginate($per_page);
        } else {
            return $chargePrices->get();
        }
    }
}
