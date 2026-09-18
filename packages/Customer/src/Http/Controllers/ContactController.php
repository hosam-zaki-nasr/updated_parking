<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Models\User;
use Customer\Foundations\Contact\ContactSearchCollection;
use Customer\Http\Requests\Contact\ContactCreateRequest;
use Customer\Http\Requests\Contact\ContactUpdateRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = ContactSearchCollection::searchContacts(
            -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($contacts));
    }

    public function search(Request $request)
    {
        $contacts = ContactSearchCollection::searchContacts(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAULT_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($contacts));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('general.retrieved'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function store(ContactCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['account_type_id'] = AccountTypeCollection::contact()->id;
        $validated['customer_id'] = auth()->id();

        $user = User::create($validated);

        return response()->success(
            trans('general.created'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function update(ContactUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }
}
