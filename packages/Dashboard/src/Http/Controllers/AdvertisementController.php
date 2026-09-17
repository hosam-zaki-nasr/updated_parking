<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Dashboard\Foundations\Advertisement\AdvertisementSearchCollection;
use Dashboard\Http\Requests\Advertisement\AdvertisementCreateRequest;
use Dashboard\Http\Requests\Advertisement\AdvertisementUpdateRequest;
use Dashboard\Http\Resources\Advertisement\AdvertisementMinifiedResource;
use Dashboard\Http\Resources\Advertisement\AdvertisementResource;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $advertisements = AdvertisementSearchCollection::searchAdvertisements(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(AdvertisementMinifiedResource::collection($advertisements));
    }

    public function search(Request $request)
    {
        $advertisements = AdvertisementSearchCollection::searchAdvertisements(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(AdvertisementMinifiedResource::collection($advertisements));
    }

    public function show(Advertisement $advertisement)
    {
        return response()->success(
            trans('general.retrieved'),
            new AdvertisementResource($advertisement),
            StatusCode::OK
        );
    }

    public function store(AdvertisementCreateRequest $request)
    {
        $advertisement = Advertisement::create($request->validated());

        return response()->success(
            trans('general.created'),
            new AdvertisementResource($advertisement),
            StatusCode::OK
        );
    }

    public function update(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        $advertisement->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new AdvertisementResource($advertisement),
            StatusCode::OK
        );
    }

    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return response()->success(
            trans('general.deleted'),
            new AdvertisementResource($advertisement),
            StatusCode::OK
        );
    }
}
