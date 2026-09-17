<?php

namespace Customer\Foundations\Car;

use App\Models\Car;

class CarQueryCollection
{
    public static function searchAllCars(
        $query_string = -1
    ) {
        return Car::where('creator_id', auth()->id())

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
