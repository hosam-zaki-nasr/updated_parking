<?php

namespace Driver\Foundations\Parking;

use App\Models\Parking;
use Carbon\Carbon;

class ParkingQueryCollection
{
    public static function searchAllParkings(
        $status = -1, //[all,current , ends]
        $starts_at = -1,
        $ends_at = -1,
        $period = -1, //[all,day,month,year]
    ) {
        
        return Parking::where('garage_id', auth()->user()->garage->id)

            ->where(function ($q) use ($status, $starts_at, $ends_at, $period) {

                if ($starts_at && $starts_at != -1 && $ends_at && $ends_at != -1) {
                    $q
                        ->whereBetween('starts_at', [
                            Carbon::create($starts_at),
                            Carbon::create($ends_at)->endOfDay()
                        ])
                        ->whereBetween('ends_at', [
                            Carbon::create($starts_at),
                            Carbon::create($ends_at)->endOfDay()
                        ]);
                } else if ($starts_at && $starts_at != -1) {

                    $q
                        ->whereBetween('starts_at', [
                            Carbon::create($starts_at)->startOfDay(),
                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($ends_at && $ends_at != -1) {

                    $q
                        ->whereBetween('ends_at', [
                            Carbon::create(1900, 01, 01),
                            Carbon::create($ends_at)->endOfDay()
                        ]);
                }

                if ($period && $period != -1) {

                    if ($period == 'day') {

                        $q
                            ->whereBetween('updated_at', [
                                Carbon::now()->startOfDay(),
                                Carbon::now()->endOfDay()
                            ]);
                    } elseif ($period == 'month') {

                        $q
                            ->whereBetween('updated_at', [
                                Carbon::now()->startOfMonth(),
                                Carbon::now()->endOfDay()
                            ]);
                    } elseif ($period == 'year') {

                        $q
                            ->whereBetween('updated_at', [
                                Carbon::now()->startOfYear(),
                                Carbon::now()->endOfDay()
                            ]);
                    }
                }

                if ($status && $status != -1) {

                    if ($status == 'current') {

                        $q->where('ends_at', null);
                    }

                    if ($status == 'ends') {

                        $q->where('ends_at', '!=', null);
                    }
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
