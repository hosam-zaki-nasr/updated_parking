<?php

namespace Driver\Foundations\Parking;

use App\Models\Parking;
use App\Models\User;
use Carbon\Carbon;

class ParkingEndCollection
{
    public static function endParking($parking)
    {

        self::calckParkedHoursAndEndPark($parking);

        $parking->update(['end_driver_id' => auth()->id()]);

        return $parking;
    }

    public static function calckParkedHoursAndEndPark(Parking $parking)
    {

        $parking->ends_at = Carbon::now();

        $start  = new Carbon($parking->starts_at);

        $end  = new Carbon($parking->ends_at);

        $minutes = $start->diff($end)->format('%I');

        $hours = $start->diffInHours($end);

        $hours = $minutes > 0 ? $start->diffInHours($end) + 1 : $hours;

        if ($minutes > 0 && $hours > 0) {

            $hours = $start->diffInHours($end) + 1;
        } elseif ($hours == 0) {

            $hours = 1;
        }

        //calc free hours
        if ($parking->garage->free_hours) {

            $hours = ceil($hours - $parking->garage->free_hours);

            if ($hours <= 0) {

                $hours = 0;
            }
        }

        $parking->total_cost = $parking->garage->valet_cost;
        // $parking->total_cost = $hours * $parking->garage->valet_cost;

        $parking->save();

        $new_balance = $parking->user->current_balance - $parking->total_cost;

        User::where('id', $parking->user_id)->update(['current_balance' => $new_balance]);

        return $parking;
    }
}
