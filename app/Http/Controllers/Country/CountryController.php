<?php

namespace App\Http\Controllers\Country;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Dashboard\Foundations\Country\CountrySearchCollection;
use Dashboard\Http\Resources\Country\CountryMinifiedResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CountryMinifiedResource::collection($countries));
    }

    public function search(Request $request)
    {
        $countries = CountrySearchCollection::searchCountries(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CountryMinifiedResource::collection($countries));
    }

    public function show(Country $country)
    {
        return response()->success(
            trans('general.retrieved'),
            new CountryMinifiedResource($country),
            StatusCode::OK
        );
    }
}
