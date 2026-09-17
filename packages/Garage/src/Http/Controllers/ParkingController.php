<?php

namespace Garage\Http\Controllers;

use App\Http\Controllers\Controller;
use Garage\Foundations\ParkingCreateCollection;
use Garage\Foundations\ParkingEndCollection;
use Garage\Foundations\RequestEndParkingCollection;
use Garage\Foundations\RequestStartParkingCollection;
use Garage\Http\Requests\ParkingCreateRequest;
use Garage\Http\Requests\ParkingEndRequest;
use Garage\Http\Requests\RequestEndParkingRequest;
use Garage\Http\Requests\RequestStartParkingRequest;
use Illuminate\Support\Facades\Log;

class ParkingController extends Controller
{

    public function requestStartParking(RequestStartParkingRequest $request)
    {
        $parking = RequestStartParkingCollection::requestStartParking($request);

        return isset($parking['error_response']) ? $parking['error_response'] : $parking;
    }

    public function startParking(ParkingCreateRequest $request)
    {
        $parking = ParkingCreateCollection::createParking($request);

        return isset($parking['error_response']) ? $parking['error_response'] : $parking;
    }

    public function requestEndParking(RequestEndParkingRequest $request)
    {
        $parking = RequestEndParkingCollection::requestEndParking($request);

        return isset($parking['error_response']) ? $parking['error_response'] : $parking;
    }

    public function endParking(ParkingEndRequest $request)
    {
        $parking = ParkingEndCollection::endParking($request);

        return isset($parking['error_response']) ? $parking['error_response'] : $parking;
    }
}
