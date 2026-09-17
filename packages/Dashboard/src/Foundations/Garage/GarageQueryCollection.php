<?php

namespace Dashboard\Foundations\Garage;

use App\Models\Garage;

class GarageQueryCollection
{
    public static function searchAllGarages(
        $country_id = -1,
        $governorate_id = -1,
        $type_id = -1,
        $query_string = -1,
        $site_number = -1,
    ) {
        return Garage::where(function ($q) use ($type_id, $query_string, $site_number, $country_id, $governorate_id) {

            if ($type_id && $type_id != -1) {

                $q
                    ->where('type_id', $type_id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%')

                    ->orWhere('name_ar', 'like', '%' . $query_string . '%');
            }

            if ($site_number && $site_number != -1) {

                $q
                    ->where('site_number', $site_number);
            }

            if ($country_id && $country_id != -1) {

                $q
                    ->where('country_id', $country_id);
            }

            if ($governorate_id && $governorate_id != -1) {

                $q
                    ->where('governorate_id', $governorate_id);
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
