<?php

namespace Garage\Foundations;

use App\Models\Parking;
use Carbon\Carbon;

class ParkingCreateCollection
{
    public static function createParking($request)
    {
        $validated = $request->validated();

        $data = $request->attributes->get('middleware_data');

        $validated['garage_id'] = $data['garage']->id;

        $validated['free_hours'] = $data['garage']->free_hours;

        $validated['hour_cost'] = $data['garage']->hour_cost;

        $validated['starts_at'] = Carbon::now();

        $validated['car_id'] = optional($data['car'])->id;

        $validated['user_id'] = $data['user']->id;

        $current_parking =  Parking::create($validated);

        return [
            'Status' => 'Authorized',
            'SessionId' => $current_parking->id,
        ];
    }
}
