<?php

namespace Garage\Foundations;

use App\Models\Parking;

class DetermineParkingCollection
{

    public static function determineParkedCar(
        $garage_id,
        $user_id,
    ) {
        return Parking::where('garage_id', $garage_id)

            ->where('user_id', $user_id)

            ->where('ends_at', null)

            ->latest()

            ->first();
    }
}
