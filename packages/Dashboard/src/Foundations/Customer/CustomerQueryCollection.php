<?php

namespace Dashboard\Foundations\Customer;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class CustomerQueryCollection
{
    public static function searchAllCustomers(
        $query_string = -1
    ) {

        $account_type_id = AccountTypeCollection::customer()->id;

        return User::whereNull('deleted_at')->where('account_type_id', $account_type_id)
            ->with('contacts')
            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%')
                        ->orWhere('email', 'like', '%' . $query_string . '%')
                        ->orWhere('phone', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
