<?php

namespace Dashboard\Foundations\Customer;

use App\Constants\SystemDefault;

class CustomerSearchCollection
{
    public static function searchCustomers(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $customers = CustomerQueryCollection::searchAllCustomers(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $customers->paginate($per_page);
        } else {
            return $customers->get();
        }
    }
}
