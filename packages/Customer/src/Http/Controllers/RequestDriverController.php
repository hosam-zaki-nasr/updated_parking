<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\RequestDriverStatusCollection;
use App\Http\Controllers\Controller;
use App\Models\NotificationRecipient;
use App\Models\RequestDriver;
use Customer\Foundations\RequestDriver\RequestDriverCollection;
use Customer\Foundations\RequestDriver\RequestDriverSearchCollection;
use Customer\Http\Requests\RequestDriver\RequestDriverEndRequest;
use Customer\Http\Requests\RequestDriver\RequestDriverStartRequest;
use Customer\Http\Resources\RequestDriver\RequestDriverMinifiedResource;
use Customer\Http\Resources\RequestDriver\RequestDriverResource;
use Illuminate\Http\Request;

class RequestDriverController extends Controller
{

    public function index(Request $request)
    {
        $requestDrivers = RequestDriverSearchCollection::searchRequestDrivers(
            -1,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(RequestDriverMinifiedResource::collection($requestDrivers));
    }

    public function search(Request $request)
    {
        $requestDrivers = RequestDriverSearchCollection::searchRequestDrivers(
            $request->get('status_id') ? $request->get('status_id') : -1,
            $request->get('driver_id') ? $request->get('driver_id') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
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

    public function requestStart(RequestDriverStartRequest $request)
    {
        $requestDriver = RequestDriverCollection::createRequestDriverStart($request);

        return response()->success(
            trans('general.done'),
            new RequestDriverResource($requestDriver),
            StatusCode::OK
        );
    }

    public function requestEnd(RequestDriverEndRequest $request)
    {

        $requestDriver = RequestDriverCollection::createRequestDriverEnd($request);

        return response()->success(
            trans('general.done'),
            new RequestDriverResource($requestDriver),
            StatusCode::OK
        );
    }

    public function destroy(RequestDriver $requestDriver)
    {
        $requestDriver->delete();

        return response()->success(
            trans('general.deleted'),
            new RequestDriverResource($requestDriver),
            StatusCode::OK
        );
    }

    public function cancel(RequestDriver $requestDriver, Request $request)
    {

        if ($requestDriver->user_id == auth()->id()) {

            $requestDriver->status_id = RequestDriverStatusCollection::canceled()->id;
            $requestDriver->canceler_id = auth()->id();
            $requestDriver->save();


            if ($request->notification_id) {

                NotificationRecipient::where('notification_id', $request->notification_id)
                    ->where('recipient_id', auth()->id())
                    ->delete();
            }

            return response()->success(
                trans('general.canceled'),
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
