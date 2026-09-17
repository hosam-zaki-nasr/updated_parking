<?php

namespace Dashboard\Foundations\ValetManager;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class ValetManagerQueryCollection
{
    public static function searchAllValetManagers(
        $query_string = -1
    ) {

        $account_type_id = AccountTypeCollection::valetManager()->id;

        return User::where('account_type_id',$account_type_id)

        ->where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
