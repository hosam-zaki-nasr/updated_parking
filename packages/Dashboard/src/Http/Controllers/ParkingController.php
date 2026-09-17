<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\Parking;
use Carbon\Carbon;
use Dashboard\Http\Resources\Report\Parking\ParkingResource;

class ParkingController extends Controller
{

    public function update(Parking $parking)
    {
        $parking->update(['ends_at' => Carbon::now(), 'force_closed' => true]);

        return response()->success(
            trans('general.updated'),
            new ParkingResource($parking),
            StatusCode::OK
        );
    }
}
