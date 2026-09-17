<?php

namespace Driver\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Parking;
use Carbon\Carbon;
use Customer\Http\Resources\Parking\ParkingResource;
use Driver\Foundations\Parking\ParkingCreateCollection;
use Driver\Foundations\Parking\ParkingEndCollection;
use Driver\Foundations\Parking\ParkingSearchCollection;
use Driver\Http\Requests\ParkingConfirmRequest;
use Driver\Http\Requests\ParkingStartRequest;
use Illuminate\Http\Request;

class ParkingController extends Controller
{

    public function index(Request $request)
    {
        $parkings = ParkingSearchCollection::searchParkings(
            -1,
            -1,
            -1,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ParkingResource::collection($parkings));
    }

    public function search(Request $request)
    {
        $parkings = ParkingSearchCollection::searchParkings(
            $request->get('status') ? $request->get('status') : -1,
            $request->get('starts_at') ? $request->get('starts_at') : -1,
            $request->get('ends_at') ? $request->get('ends_at') : -1,
            $request->get('period') ? $request->get('period') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ParkingResource::collection($parkings));
    }

    public function show(Parking $parking)
    {
        return response()->success(
            trans('general.retrieved'),
            new ParkingResource($parking),
            StatusCode::OK
        );
    }

    public function startParking(ParkingStartRequest $request)
    {
        $parking = ParkingCreateCollection::createParking($request);

        if (isset($parking['error_response'])) {

            return response()->error(
                $parking['error_response']['UnauthorizedReason'],
                [],
                StatusCode::BAD_REQUEST
            );
        };

        return response()->success(
            trans('driver.parking_started_successfully'),
            new ParkingResource($parking),
            StatusCode::OK
        );
    }

    public function startParkingConfirm(ParkingConfirmRequest $request, Parking $parking)
    {

        $validated = $request->validated();

        $validated['start_confirmed_at'] = Carbon::now();

        $parking->update($validated);

        return response()->success(
            trans('driver.parking_start_confirmed_successfully'),
            new ParkingResource($parking),
            StatusCode::OK
        );
    }

    public function endParking(Parking $parking)
    {
        $parking = ParkingEndCollection::endParking($parking);

        return response()->success(
            trans('driver.parking_ended_successfully'),
            new ParkingResource($parking),
            StatusCode::OK
        );
    }
}
