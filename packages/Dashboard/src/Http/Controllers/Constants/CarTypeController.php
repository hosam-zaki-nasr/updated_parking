<?php

namespace Dashboard\Http\Controllers\Constants;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\CarType;
use Dashboard\Foundations\Constants\CarType\CarTypeSearchCollection;
use Dashboard\Http\Requests\Constants\CarType\CarTypeCreateRequest;
use Dashboard\Http\Requests\Constants\CarType\CarTypeUpdateRequest;
use Dashboard\Http\Resources\Constants\CarType\CarTypeMinifiedResource;
use Dashboard\Http\Resources\Constants\CarType\CarTypeResource;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    public function index(Request $request)
    {
        $carTypes = CarTypeSearchCollection::searchCarTypes(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarTypeMinifiedResource::collection($carTypes));
    }

    public function search(Request $request)
    {
        $carTypes = CarTypeSearchCollection::searchCarTypes(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarTypeMinifiedResource::collection($carTypes));
    }

    public function show(CarType $carType)
    {
        return response()->success(
            trans('general.retrieved'),
            new CarTypeResource($carType),
            StatusCode::OK
        );
    }

    public function store(CarTypeCreateRequest $request)
    {
        $carType = CarType::create($request->validated());

        return response()->success(
            trans('general.created'),
            new CarTypeResource($carType),
            StatusCode::OK
        );
    }

    public function update(CarTypeUpdateRequest $request, CarType $carType)
    {
        $carType->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new CarTypeResource($carType),
            StatusCode::OK
        );
    }

    public function destroy(CarType $carType)
    {
        $carType->delete();

        return response()->success(
            trans('general.deleted'),
            new CarTypeResource($carType),
            StatusCode::OK
        );
    }
}
