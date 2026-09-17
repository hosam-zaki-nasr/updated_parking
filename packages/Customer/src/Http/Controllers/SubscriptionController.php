<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Customer\Foundations\Subscription\SubscriptionCreateCollection;
use Customer\Foundations\Subscription\SubscriptionSearchCollection;
use Customer\Http\Requests\Subscription\SubscriptionCreateRequest;
use Customer\Http\Requests\Subscription\SubscriptionUpdateRequest;
use Customer\Http\Resources\Subscription\SubscriptionMinifiedResource;
use Customer\Http\Resources\Subscription\SubscriptionResource;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = SubscriptionSearchCollection::searchSubscriptions(
            $request->get('garage_id') ? $request->get('garage_id') : -1,
            $request->get('starts_at') ? $request->get('starts_at') : -1,
            $request->get('ends_at') ? $request->get('ends_at') : -1,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(SubscriptionMinifiedResource::collection($subscriptions));
    }

    public function store(SubscriptionCreateRequest $request)
    {
        $subscription = SubscriptionCreateCollection::createSubscription($request);

        return response()->success(
            trans('generla.created'),
            new SubscriptionResource($subscription),
            StatusCode::OK
        );
    }

    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return response()->success(
            trans('generla.updated'),
            new SubscriptionResource($subscription),
            StatusCode::OK
        );
    }
}
