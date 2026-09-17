<?php

namespace Driver\Foundations\RequestDriver;

use App\Foundations\LookupType\RequestDriverStatusCollection;
use App\Models\RequestDriver;

class RequestDriverQueryCollection
{
    public static function searchAllRequestDrivers(
        $query_string = -1
    ) {
        return RequestDriver::where('garage_id', auth()->user()->garage_id)

            // ->where('status_id', RequestDriverStatusCollection::pending()->id)

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('details', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
