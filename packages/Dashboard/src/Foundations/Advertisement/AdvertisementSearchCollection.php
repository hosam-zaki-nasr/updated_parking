<?php

namespace Dashboard\Foundations\Advertisement;

use App\Constants\SystemDefault;

class AdvertisementSearchCollection
{
    public static function searchAdvertisements(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $advertisements = AdvertisementQueryCollection::searchAllAdvertisements(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $advertisements->paginate($per_page);
        } else {
            return $advertisements->get();
        }
    }
}
