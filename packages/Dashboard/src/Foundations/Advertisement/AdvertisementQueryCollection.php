<?php

namespace Dashboard\Foundations\Advertisement;

use App\Models\Advertisement;

class AdvertisementQueryCollection
{
    public static function searchAllAdvertisements(
        $query_string = -1
    ) {
        return Advertisement::where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('title', 'like', '%' . $query_string . '%')
                    ->orWhere('details', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
