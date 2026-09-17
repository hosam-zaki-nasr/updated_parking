<?php

namespace Dashboard\Foundations\ValetDriver;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class ValetDriverQueryCollection
{
    public static function searchAllValetDrivers(
        $garage_id = -1,
        $query_string = -1
    ) {

        $account_type_id = AccountTypeCollection::driver()->id;

        return User::where('account_type_id', $account_type_id)

            ->where(function ($q) use ($garage_id, $query_string) {

                if ($garage_id && $garage_id != -1) {

                    $q
                        ->where('garage_id',  $garage_id);
                }

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
