<?php

namespace Garage\Foundations;

use App\Models\Car;

class DetermineCarCollection
{

    public static function determineCar(
        $number = -1
    ) {
        return Car::where(function ($q) use ($number) {

            if ($number && $number != -1) {

                $q
                    ->where('number', $number);
            }
        })
            ->first();
    }
}
