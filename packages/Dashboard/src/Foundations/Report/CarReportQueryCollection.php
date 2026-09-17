<?php

namespace Dashboard\Foundations\Report;

use App\Models\Car;
use Carbon\Carbon;

class CarReportQueryCollection
{
    public static function searchAllCarReports(
        $customer_id = -1,
        $query_string = -1,
        $full_number = -1,
        $date_from = -1,
        $date_to = -1,
        $car_color_id = -1,
        $car_type_id = -1,
    ) {

        return Car::whereNull('deleted_at')
            ->where(function ($q) use (
                $customer_id,
                $query_string,
                $full_number,
                $date_from,
                $date_to,
                $car_color_id,
                $car_type_id,
            ) {

                if ($customer_id && $customer_id != -1) {

                    $q
                        ->where('creator_id', $customer_id);
                }

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }

                if ($full_number && $full_number != -1) {

                    $q
                        ->where('full_number','like', '%'.$full_number.'%');
                }


                if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create($date_from),
                            Carbon::create($date_to)->endOfDay()
                        ]);
                } else if ($date_from && $date_from != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create($date_from)->startOfDay(),
                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [
                            Carbon::create(1900, 01, 01),
                            Carbon::create($date_to)->endOfDay()
                        ]);
                }

                if ($car_color_id && $car_color_id != -1) {

                    $q
                        ->where('car_color_id', $car_color_id);
                }

                if ($car_type_id && $car_type_id != -1) {

                    $q
                        ->where('car_type_id', $car_type_id);
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
