<?php

namespace Customer\Foundations\Contact;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class ContactQueryCollection
{
    public static function searchAllContacts(
        $query_string = -1
    ) {

        $account_type_id = AccountTypeCollection::contact()->id;

        return User::where('account_type_id', $account_type_id)

            ->where('customer_id', auth()->id())

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
