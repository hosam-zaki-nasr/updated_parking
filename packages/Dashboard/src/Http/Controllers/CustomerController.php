<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dashboard\Foundations\Customer\CustomerSearchCollection;
use Dashboard\Http\Requests\Customer\CustomerCreateRequest;
use Dashboard\Http\Requests\Customer\CustomerUpdateRequest;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Dashboard\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $valetDrivers = CustomerSearchCollection::searchCustomers(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CustomerMinifiedResource::collection($valetDrivers));
    }

    public function search(Request $request)
    {
        $valetDrivers = CustomerSearchCollection::searchCustomers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(CustomerMinifiedResource::collection($valetDrivers));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('general.retrieved'),
            new CustomerResource($user),
            StatusCode::OK
        );
    }

    public function store(CustomerCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['account_type_id'] = AccountTypeCollection::customer()->id;

        $user = User::create($validated);

        return response()->success(
            trans('general.created'),
            new CustomerResource($user),
            StatusCode::OK
        );
    }

    public function update(CustomerUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new CustomerResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new CustomerResource($user),
            StatusCode::OK
        );
    }
}
