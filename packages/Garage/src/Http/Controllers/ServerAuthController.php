<?php

namespace Garage\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use Garage\Foundations\LoginCollection;
use Garage\Http\Requests\LoginRequest;
use Garage\Http\Resources\ServerTokenResource;

class ServerAuthController extends Controller
{

    public function ping()
    {
        return [
            'IsOK' => true
        ];
    }

    public function login(LoginRequest $request)
    {
        $user = LoginCollection::login($request);

        if ($user) {
            return response()->json(
                new ServerTokenResource($user),
            );
        } else {
            return response()->error(
                'server_unauthorized',
                [],
                StatusCode::UNAUTHORIZED
            );
        }
    }
}
