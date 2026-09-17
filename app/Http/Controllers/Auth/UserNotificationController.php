<?php

namespace App\Http\Controllers\Auth;

use App\Constants\GeneralBooleanStatus;
use App\Constants\StatusCode;
use App\Foundations\Notification\NotificationCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserNotificationTokenRequest;
use App\Http\Resources\Auth\UserNotificationTokenResource;
use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Models\UserNotificationToken;

class UserNotificationController extends Controller
{

    public function index()
    {

        $notifications =  NotificationCollection::getUserNotifications(auth()->id());

        NotificationCollection::markReadNotifications($notifications->items());

        return response()->paginated(NotificationResource::collection($notifications));
    }

    public function search()
    {

        $notifications =  NotificationCollection::getUserNotifications(auth()->id());

        NotificationCollection::markReadNotifications($notifications->items());

        return response()->paginated(NotificationResource::collection($notifications));
    }

    public function store(CreateUserNotificationTokenRequest $request)
    {
        $validated = $request->validated();

        $validated['current_token'] =  explode("Bearer ", $request->header("Authorization"))[1];

        $validated['user_id'] =  auth()->id();

        $notification_token = UserNotificationToken::create($validated);

        return response()->success(
            trans('general.created'),
            new UserNotificationTokenResource($notification_token),
            StatusCode::OK
        );
    }

    public function muteNotifications()
    {
        User::where('id', auth()->id())->update(['notification_status' => GeneralBooleanStatus::OFF['code']]);

        return response()->success(
            trans('general.done'),
            [],
            StatusCode::OK
        );
    }

    public function unmuteNotifications()
    {
        User::where('id', auth()->id())->update(['notification_status' => GeneralBooleanStatus::ON['code']]);

        return response()->success(
            trans('general.done'),
            [],
            StatusCode::OK
        );
    }
}
