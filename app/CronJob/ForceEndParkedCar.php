<?php

namespace App\CronJob;

use App\Models\Parking;
use Carbon\Carbon;

class ForceEndParkedCar
{
    public static function endParkedCars(): void
    {
        Parking::where('ends_at', null)
            ->update([
                'ends_at' => Carbon::now(),
                'force_closed' => true
            ]);
    }
}
