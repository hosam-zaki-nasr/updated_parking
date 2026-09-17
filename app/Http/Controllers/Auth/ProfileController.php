<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\UpdateProfileCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Models\User;

class ProfileController extends Controller
{

    public function show()
    {
        return response()->success(
            trans('general.retrieved'),
            new UserMinifiedResource(auth()->user()),
            StatusCode::OK
        );
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = UpdateProfileCollection::updateProfile($request->validated());

        return response()->success(
            trans('general.updated'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function destroy()
    {
        $user = User::find(auth()->id());

        /*    if ($user->customer_id == null && $user->contacts->count()) {

            $user->contacts->delete();
        } */

        $user->delete();

        return response()->success(
            trans('general.deleted'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }
}
