<?php

namespace Dashboard\Foundations\Report;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;
use Carbon\Carbon;

class CustomerReportQueryCollection
{
    public static function searchAllCustomerReports(
        $query_string = -1,
        $country_id = -1,
        $governorate_id = -1,
        $date_from = -1,
        $date_to = -1,
    ) {

        $account_type_id = AccountTypeCollection::customer()->id;

        return User::whereNull('deleted_at')->where('account_type_id', $account_type_id)
            ->with('contacts')
            ->where(function ($q) use (
                $query_string,
                $country_id,
                $governorate_id,
                $date_from,
                $date_to
            ) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%')
                        ->orWhere('email', 'like', '%' . $query_string . '%')
                        ->orWhere('phone', 'like', '%' . $query_string . '%');
                }

                if ($country_id && $country_id != -1) {

                    $q
                        ->where('country_id', $country_id);
                }

                if ($governorate_id && $governorate_id != -1) {

                    $q
                        ->where('governorate_id', $governorate_id);
                }

                if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create($date_from),
                            Carbon::create($date_to)->endOfDay()
                        ]);
                } else if ($date_from && $date_from != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create($date_from)->startOfDay(),
                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create(1900, 01, 01),
                            Carbon::create($date_to)->endOfDay()
                        ]);
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
