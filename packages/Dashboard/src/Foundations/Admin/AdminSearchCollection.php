<?php

namespace Dashboard\Foundations\Admin;

use App\Constants\SystemDefault;

class AdminSearchCollection
{
    public static function searchAdmins(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $admins = AdminQueryCollection::searchAllAdmins(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $admins->paginate($per_page);
        } else {
            return $admins->get();
        }
    }
}
