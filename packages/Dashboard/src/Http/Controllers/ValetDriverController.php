<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dashboard\Foundations\ValetDriver\ValetDriverSearchCollection;
use Dashboard\Http\Requests\ValetDriver\ValetDriverCreateRequest;
use Dashboard\Http\Requests\ValetDriver\ValetDriverUpdateRequest;
use Dashboard\Http\Resources\ValetDriver\ValetDriverMinifiedResource;
use Dashboard\Http\Resources\ValetDriver\ValetDriverResource;
use Illuminate\Http\Request;

class ValetDriverController extends Controller
{
    public function index(Request $request)
    {
        $valetDrivers = ValetDriverSearchCollection::searchValetDrivers(
            -1,
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ValetDriverMinifiedResource::collection($valetDrivers));
    }

    public function search(Request $request)
    {
        $valetDrivers = ValetDriverSearchCollection::searchValetDrivers(
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ValetDriverMinifiedResource::collection($valetDrivers));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('general.retrieved'),
            new ValetDriverResource($user),
            StatusCode::OK
        );
    }

    public function store(ValetDriverCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['account_type_id'] = AccountTypeCollection::driver()->id;

        $user = User::create($validated);

        return response()->success(
            trans('general.created'),
            new ValetDriverResource($user),
            StatusCode::OK
        );
    }

    public function update(ValetDriverUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new ValetDriverResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new ValetDriverResource($user),
            StatusCode::OK
        );
    }
}
