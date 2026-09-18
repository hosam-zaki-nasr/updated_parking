<?php

namespace App\Http\Controllers\Country;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as Governorate;
use Dashboard\Foundations\Country\Governorate\GovernorateSearchCollection;
use Dashboard\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $governorates = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function search(Country $country, Request $request)
    {
        $governorates = GovernorateSearchCollection::searchCountryGovernorates(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function searchAll(Request $request)
    {
        $governorates = GovernorateSearchCollection::searchAllGovernorates(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(GovernorateMinifiedResource::collection($governorates));
    }

    public function show(Governorate $governorate)
    {
        return response()->success(
            trans('general.retrieved'),
            new GovernorateMinifiedResource($governorate),
            StatusCode::OK
        );
    }
}
