<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Garage;
use Dashboard\Foundations\Garage\GarageSearchCollection;
use Dashboard\Http\Requests\Garage\GarageCreateRequest;
use Dashboard\Http\Requests\Garage\GarageUpdateRequest;
use Dashboard\Http\Resources\Garage\GarageMinifiedResource;
use Dashboard\Http\Resources\Garage\GarageResource;
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
            $request->get('country_id') ? $request->get('country_id') : -1,
            $request->get('governorate_id') ? $request->get('governorate_id') : -1,
            $request->get('type_id') ? $request->get('type_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('site_number') ? $request->get('site_number') : -1,
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

    public function store(GarageCreateRequest $request)
    {
        $garage = Garage::create($request->validated());

        return response()->success(
            trans('general.created'),
            new GarageResource($garage),
            StatusCode::OK
        );
    }

    public function update(GarageUpdateRequest $request, Garage $garage)
    {
        $garage->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new GarageResource($garage),
            StatusCode::OK
        );
    }

    public function destroy(Garage $garage)
    {
        $garage->delete();

        return response()->success(
            trans('general.deleted'),
            new GarageResource($garage),
            StatusCode::OK
        );
    }
}
