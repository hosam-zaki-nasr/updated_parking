<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dashboard\Foundations\Admin\AdminSearchCollection;
use Dashboard\Http\Requests\Admin\AdminCreateRequest;
use Dashboard\Http\Requests\Admin\AdminUpdateRequest;
use Dashboard\Http\Resources\Admin\AdminMinifiedResource;
use Dashboard\Http\Resources\Admin\AdminResource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = AdminSearchCollection::searchAdmins(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(AdminMinifiedResource::collection($admins));
    }

    public function search(Request $request)
    {
        $admins = AdminSearchCollection::searchAdmins(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(AdminMinifiedResource::collection($admins));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('general.retrieved'),
            new AdminResource($user),
            StatusCode::OK
        );
    }

    public function store(AdminCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['account_type_id'] = AccountTypeCollection::admin()->id;

        $user = User::create($validated);

        return response()->success(
            trans('general.created'),
            new AdminResource($user),
            StatusCode::OK
        );
    }

    public function update(AdminUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new AdminResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new AdminResource($user),
            StatusCode::OK
        );
    }
}
