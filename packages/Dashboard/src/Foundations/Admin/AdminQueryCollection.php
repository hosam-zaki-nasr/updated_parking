<?php

namespace Dashboard\Foundations\Admin;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class AdminQueryCollection
{
    public static function searchAllAdmins(
        $query_string = -1
    ) {

        $account_type_id = AccountTypeCollection::admin()->id;

        return User::where('account_type_id', $account_type_id)

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%')

                        ->orWhere('email', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
