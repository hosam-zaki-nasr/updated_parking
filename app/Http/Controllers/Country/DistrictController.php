<?php

namespace App\Http\Controllers\Country;

use Dashboard\Foundations\Country\District\DistrictSearchCollection;
use Dashboard\Http\Resources\Country\District\DistrictMinifiedResource;
use Dashboard\Http\Resources\Country\District\DistrictResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $districts = DistrictSearchCollection::searchCountryDistricts(
            $country,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function search(Country $country, Request $request)
    {
        $districts = DistrictSearchCollection::searchCountryDistricts(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function searchAll(Request $request)
    {
        $districts = DistrictSearchCollection::searchAllDistricts(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(DistrictMinifiedResource::collection($districts));
    }

    public function show(District $district)
    {
        return response()->success(
            trans('general.retrieved'),
            new DistrictResource($district),
            StatusCode::OK
        );
    }
}
