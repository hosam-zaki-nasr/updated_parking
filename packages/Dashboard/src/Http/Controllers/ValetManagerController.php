<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dashboard\Foundations\ValetManager\ValetManagerSearchCollection;
use Dashboard\Http\Requests\ValetManager\ValetManagerCreateRequest;
use Dashboard\Http\Requests\ValetManager\ValetManagerUpdateRequest;
use Dashboard\Http\Resources\ValetManager\ValetManagerMinifiedResource;
use Dashboard\Http\Resources\ValetManager\ValetManagerResource;
use Illuminate\Http\Request;

class ValetManagerController extends Controller
{
    public function index(Request $request)
    {
        $valetManagers = ValetManagerSearchCollection::searchValetManagers(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ValetManagerMinifiedResource::collection($valetManagers));
    }

    public function search(Request $request)
    {
        $valetManagers = ValetManagerSearchCollection::searchValetManagers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ValetManagerMinifiedResource::collection($valetManagers));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('general.retrieved'),
            new ValetManagerResource($user),
            StatusCode::OK
        );
    }

    public function store(ValetManagerCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['account_type_id'] = AccountTypeCollection::valetManager()->id;

        $user = User::create($validated);

        return response()->success(
            trans('general.created'),
            new ValetManagerResource($user),
            StatusCode::OK
        );
    }

    public function update(ValetManagerUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new ValetManagerResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new ValetManagerResource($user),
            StatusCode::OK
        );
    }
}
