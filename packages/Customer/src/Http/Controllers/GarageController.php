<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Garage;
use Customer\Foundations\Garage\GarageSearchCollection;
use Customer\Http\Resources\Garage\GarageMinifiedResource;
use Customer\Http\Resources\Garage\GarageResource;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    public function index(Request $request)
    {
        $garages = GarageSearchCollection::searchGarages(
            -1,
            -1,
            -1,
            -1,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GarageMinifiedResource::collection($garages));
    }

    public function search(Request $request)
    {
        $garages = GarageSearchCollection::searchGarages(
            $request->get('radius') ? $request->get('radius') : SystemDefault::DEFAULT_RADIUS_VALUE,
            $request->get('longitude') ? $request->get('longitude') : -1,
            $request->get('latitude') ? $request->get('latitude') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('type_id') ? $request->get('type_id') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GarageMinifiedResource::collection($garages));
    }

    public function searchParkingGarages(Request $request)
    {
        $garages = GarageSearchCollection::searchParkingGarages(
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GarageMinifiedResource::collection($garages));
    }

    public function show(Garage $garage)
    {
        return response()->success(
            trans('general.retrieved'),
            new GarageResource($garage),
            StatusCode::OK
        );
    }
}
