<?php

namespace Dashboard\Foundations\Constants\CarType;

use App\Models\CarType;

class CarTypeQueryCollection
{
    public static function searchAllCarTypes(
        $query_string = -1
    ) {
        return CarType::where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
