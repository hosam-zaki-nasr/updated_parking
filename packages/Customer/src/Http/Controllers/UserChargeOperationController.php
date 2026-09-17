<?php

namespace Customer\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use Customer\Foundations\Payment\PaymentCollection;
use Customer\Http\Requests\UserChargeOperation\UserChargeOperationCreateRequest;
use Customer\Http\Resources\UserChargeOperation\CurrentBalanceResource;
use Customer\Http\Resources\UserChargeOperation\RedirectLinkPaymentResource;
use Illuminate\Http\Request;

class UserChargeOperationController extends Controller
{
    public function index()
    {
        return response()->success(
            trans('user_charge_operation.current_balance_retrived_successfully'),
            new CurrentBalanceResource(auth()->user()),
            StatusCode::OK
        );
    }

    public function store(UserChargeOperationCreateRequest $request)
    {
        $userChargeOperation = PaymentCollection::createPayment($request);

        if ($userChargeOperation) {
            return response()->success(
                trans('user_charge_operation.user_charge_operation_created_successfully'),
                new RedirectLinkPaymentResource($userChargeOperation),
                StatusCode::OK
            );
        }

        return response()->error(
            trans('user_charge_operation.user_charge_operation_failed'),
            [],
            StatusCode::NOT_ACCEPTABLE
        );
    }

    public function successPage(Request $request)
    {
        $userChargeOperation = PaymentCollection::createPaymentOperation($request);

        return view('successPayment', $userChargeOperation);
    }
}
