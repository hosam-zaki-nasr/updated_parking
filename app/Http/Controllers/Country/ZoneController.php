<?php

namespace App\Http\Controllers\Country;

use Dashboard\Foundations\Country\Zone\ZoneSearchCollection;
use Dashboard\Http\Resources\Country\Zone\ZoneMinifiedResource;
use Dashboard\Http\Resources\Country\Zone\ZoneResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Country as Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index(Country $country, Request $request)
    {
        $zones = ZoneSearchCollection::searchCountryZones(
            $country,
            -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function search(Country $country, Request $request)
    {
        $zones = ZoneSearchCollection::searchCountryZones(
            $country,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function searchAll(Request $request)
    {
        $zones = ZoneSearchCollection::searchAllZones(
            $request->get('country_id') ?? -1,
            $request->get('query_string') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(ZoneMinifiedResource::collection($zones));
    }

    public function show(Zone $zone)
    {
        return response()->success(
            trans('general.retrieved'),
            new ZoneResource($zone),
            StatusCode::OK
        );
    }
}
