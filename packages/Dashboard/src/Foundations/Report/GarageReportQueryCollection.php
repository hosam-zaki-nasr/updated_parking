<?php

namespace Dashboard\Foundations\Report;

use App\Models\Garage;
use Carbon\Carbon;

class GarageReportQueryCollection
{
    public static function searchAllGarageReports(
        $garage_id = -1,
        $type_id = -1,
        $status = -1,
        $starts_at = -1,
        $ends_at = -1,
        $period = -1,

        $car_type_id = -1,
        $car_number = -1,
        $customer_name = -1,
        $query_string = -1,
    ) {
        return Garage::where(function ($q) use (
            $garage_id,
            $type_id,
            $status,
            $starts_at,
            $ends_at,
            $period,
            $car_type_id,
            $car_number,
            $customer_name,
            $query_string,
        ) {

            if ($garage_id && $garage_id != -1) {

                $q
                    ->where('id', $garage_id);
            }

            if ($type_id && $type_id != -1) {

                $q
                    ->where('type_id', $type_id);
            }


            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }

            if (
                ($status && $status != -1)
                or ($starts_at && $starts_at != -1)
                or ($ends_at && $ends_at != -1)
                or ($period && $period != -1)
                or ($car_type_id && $car_type_id != -1)
                or ($car_number && $car_number != -1)
                or ($customer_name && $customer_name != -1)
            ) {

                $q
                    ->whereHas('parking', function ($q) use (
                        $status,
                        $starts_at,
                        $ends_at,
                        $period,
                        $car_type_id,
                        $car_number,
                        $customer_name,
                    ) {

                        if ($status && $status != -1) {

                            if ($status == 'current') {

                                $q->where('ends_at', null);
                            }

                            if ($status == 'ends') {

                                $q->where('ends_at', '!=', null);
                            }
                        }

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

                        if (
                            ($car_type_id && $car_type_id != -1) or
                            ($car_number && $car_number != -1)
                        ) {

                            $q
                                ->whereHas('car', function ($q) use ($car_type_id, $car_number) {

                                    if ($car_type_id && $car_type_id != -1) {

                                        $q
                                            ->where('car_type_id', $car_type_id);
                                    }

                                    if ($car_number && $car_number != -1) {
                                        $q
                                            ->where('full_number', $car_number);
                                    }
                                });
                        }

                        if (
                            $customer_name && $customer_name != -1
                        ) {

                            $q
                                ->whereHas('user', function ($q) use ($customer_name) {

                                    if ($customer_name && $customer_name != -1) {

                                        $q
                                            ->where('name', 'like', '%' . $customer_name . '%');
                                    }
                                });
                        }
                    });
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
