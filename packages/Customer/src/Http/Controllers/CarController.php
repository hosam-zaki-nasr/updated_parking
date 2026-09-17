<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Customer\Foundations\Car\CarSearchCollection;
use Customer\Http\Requests\Car\CarCreateRequest;
use Customer\Http\Requests\Car\CarUpdateRequest;
use Customer\Http\Resources\Car\CarMinifiedResource;
use Customer\Http\Resources\Car\CarResource;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = CarSearchCollection::searchCars(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarMinifiedResource::collection($cars));
    }

    public function search(Request $request)
    {
        $cars = CarSearchCollection::searchCars(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CarMinifiedResource::collection($cars));
    }

    public function show(Car $car)
    {
        return response()->success(
            trans('general.retrieved'),
            new CarResource($car),
            StatusCode::OK
        );
    }

    public function store(CarCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['full_number'] = $validated['number'] . $validated['text'];

        $car = Car::create($validated);

        return response()->success(
            trans('general.created'),
            new CarResource($car),
            StatusCode::OK
        );
    }

    public function update(CarUpdateRequest $request, Car $car)
    {

        $validated = $request->validated();

        $validated['full_number'] = $validated['number'] . $validated['text'];

        $car->update($validated);

        return response()->success(
            trans('general.updated'),
            new CarResource($car),
            StatusCode::OK
        );
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->success(
            trans('general.deleted'),
            new CarResource($car),
            StatusCode::OK
        );
    }
}
