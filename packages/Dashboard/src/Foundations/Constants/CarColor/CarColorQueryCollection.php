<?php

namespace Dashboard\Foundations\Constants\CarColor;

use App\Models\CarColor;

class CarColorQueryCollection
{
    public static function searchAllCarColors(
        $query_string = -1
    ) {
        return CarColor::where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%')

                    ->orWhere('code', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
