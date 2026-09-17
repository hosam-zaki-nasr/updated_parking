<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Parking;
use Customer\Foundations\Parking\ParkingSearchCollection;
use Customer\Http\Resources\Parking\ParkingResource;
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
}
