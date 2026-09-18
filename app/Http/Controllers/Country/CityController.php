<?php

namespace App\Http\Controllers\Country;

use Dashboard\Foundations\Country\City\CitySearchCollection;
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
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CityMinifiedResource::collection($cities));
    }

    public function search(Country $country, Request $request)
    {
        $cities = CitySearchCollection::searchCountryCities(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CityMinifiedResource::collection($cities));
    }

    public function searchAll(Request $request)
    {
        $cities = CitySearchCollection::searchAllCities(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
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
}
