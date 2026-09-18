<?php

namespace Customer\Foundations\Contact;

use App\Constants\SystemDefault;

class ContactSearchCollection
{
    public static function searchContacts(
        $query_string = -1,
        $paginate = -1,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {
        $contacts = ContactQueryCollection::searchAllContacts(
            $query_string
        );

        if ($paginate && $paginate != -1) {

            return $contacts->paginate($per_page);
        } else {
            return $contacts->get();
        }
    }
}
