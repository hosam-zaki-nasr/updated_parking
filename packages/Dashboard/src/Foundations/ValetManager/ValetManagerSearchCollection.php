<?php

namespace Dashboard\Foundations\ValetManager;

use App\Constants\SystemDefault;

class ValetManagerSearchCollection
{
    public static function searchValetManagers(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $valetManagers = ValetManagerQueryCollection::searchAllValetManagers(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $valetManagers->paginate($per_page);
        } else {
            return $valetManagers->get();
        }
    }
}
