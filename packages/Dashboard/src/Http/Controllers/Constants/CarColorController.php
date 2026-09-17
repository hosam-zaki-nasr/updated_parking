<?php

namespace Dashboard\Http\Controllers\Constants;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\CarColor;
use Dashboard\Foundations\Constants\CarColor\CarColorSearchCollection;
use Dashboard\Http\Requests\Constants\CarColor\CarColorCreateRequest;
use Dashboard\Http\Requests\Constants\CarColor\CarColorUpdateRequest;
use Dashboard\Http\Resources\Constants\CarColor\CarColorMinifiedResource;
use Dashboard\Http\Resources\Constants\CarColor\CarColorResource;
use Illuminate\Http\Request;

class CarColorController extends Controller
{
    public function index(Request $request)
    {
        $carColors = CarColorSearchCollection::searchCarColors(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarColorMinifiedResource::collection($carColors));
    }

    public function search(Request $request)
    {
        $carColors = CarColorSearchCollection::searchCarColors(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarColorMinifiedResource::collection($carColors));
    }

    public function show(CarColor $carColor)
    {
        return response()->success(
            trans('general.retrieved'),
            new CarColorResource($carColor),
            StatusCode::OK
        );
    }

    public function store(CarColorCreateRequest $request)
    {
        $carColor = CarColor::create($request->validated());

        return response()->success(
            trans('general.created'),
            new CarColorResource($carColor),
            StatusCode::OK
        );
    }

    public function update(CarColorUpdateRequest $request, CarColor $carColor)
    {
        $carColor->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new CarColorResource($carColor),
            StatusCode::OK
        );
    }

    public function destroy(CarColor $carColor)
    {
        $carColor->delete();

        return response()->success(
            trans('general.deleted'),
            new CarColorResource($carColor),
            StatusCode::OK
        );
    }
}
