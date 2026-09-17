<?php

namespace Dashboard\Http\Controllers\Country;

use Dashboard\Foundations\Country\City\CityCreateCollection;
use Dashboard\Foundations\Country\City\CitySearchCollection;
use Dashboard\Http\Requests\Country\CityCreateRequest;
use Dashboard\Http\Requests\Country\CityUpdateRequest;
use Dashboard\Http\Resources\Country\City\CityMinifiedResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $cities = CitySearchCollection::searchCountryCities(
            $country,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CityMinifiedResource::collection($cities));
    }

    public function search(Country $country, Request $request)
    {
        $cities = CitySearchCollection::searchCountryCities(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CityMinifiedResource::collection($cities));
    }

    public function searchAll(Request $request)
    {
        $cities = CitySearchCollection::searchAllCities(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CityMinifiedResource::collection($cities));
    }

    public function show(City $city)
    {
        return response()->success(
            trans('general.retrieved'),
            new CityMinifiedResource($city),
            StatusCode::OK
        );
    }

    public function store(CityCreateRequest $request)
    {
        $city =  CityCreateCollection::createCity($request->validated());

        return response()->success(
            trans('general.created'),
            new CityMinifiedResource($city),
            StatusCode::OK
        );
    }

    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new CityMinifiedResource($city),
            StatusCode::OK
        );
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->success(
            trans('general.deleted'),
            new CityMinifiedResource($city),
            StatusCode::OK
        );
    }
}
