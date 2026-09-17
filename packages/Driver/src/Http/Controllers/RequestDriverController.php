<?php

namespace Driver\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\RequestDriver;
use Driver\Foundations\RequestDriver\RequestDriverSearchCollection;
use Customer\Http\Resources\RequestDriver\RequestDriverMinifiedResource;
use Customer\Http\Resources\RequestDriver\RequestDriverResource;
use Driver\Foundations\RequestDriver\RequestDriverCollection;
use Illuminate\Http\Request;

class RequestDriverController extends Controller
{

    public function index(Request $request)
    {
        $requestDrivers = RequestDriverSearchCollection::searchRequestDrivers(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(RequestDriverMinifiedResource::collection($requestDrivers));
    }

    public function search(Request $request)
    {
        $requestDrivers = RequestDriverSearchCollection::searchRequestDrivers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(RequestDriverMinifiedResource::collection($requestDrivers));
    }

    public function show(RequestDriver $requestDriver)
    {
        return response()->success(
            trans('general.retrieved'),
            new RequestDriverResource($requestDriver),
            StatusCode::OK
        );
    }

    public function accept(RequestDriver $requestDriver)
    {

        $requestDriver = RequestDriverCollection::acceptRequestDriver($requestDriver);

        if ($requestDriver != false) {

            return response()->success(
                trans('general.accepted'),
                new RequestDriverResource($requestDriver),
                StatusCode::OK
            );
        }

        return response()->error(
            trans('general.failed'),
            [],
            StatusCode::BAD_REQUEST
        );
    }

    public function disaccept(RequestDriver $requestDriver, Request $request)
    {
        $requestDriver = RequestDriverCollection::disacceptRequestDriver(
            $requestDriver,
            $request->reasone ? $request->reasone : null
        );

        if ($requestDriver != false) {
            return response()->success(
                trans('general.accepted'),
                new RequestDriverResource($requestDriver),
                StatusCode::OK
            );
        }

        return response()->error(
            trans('general.not_assigned_to_you'),
            [],
            StatusCode::BAD_REQUEST
        );
    }
}
