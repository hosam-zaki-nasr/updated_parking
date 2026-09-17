<?php

namespace Customer\Foundations\Payment;

use App\Models\User;
use App\Models\UserChargeOperation;
use Customer\Http\Requests\UserChargeOperation\UserChargeOperationCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentCollection
{

    public static function createPayment(UserChargeOperationCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        $url = url('api/customer/success-page?validated_data=' . json_encode($validated));

        $response =  PaymentCollection::pay($validated['amount'], $url);

        if ($response && isset($response->code) && $response->code == 4) {

            $amount = 12.60;

            sleep(5);

            $response =  PaymentCollection::pay($amount, $url);
        }

        if ($response && isset($response->tran_ref)) {

            Log::info([$response]);

            return ['payment_link' => $response->redirect_url];
        }

        return false;
    }

    public static function pay($amount, $url)
    {

        return Http::withHeaders([
            'Authorization' =>  'SHJNLTWBRR-JHWJZ6BKJ2-6BDNRL29TZ',
            'Content-Type' => 'application/json'
        ])->post('https://secure.clickpay.com.sa/payment/request', [

            'profile_id' => '44638',
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => '4244b9fd-c7e9-4f16-8d3c-4fe7bf6c48ca',
            'cart_description' => 'New Park Payment',
            'cart_currency' => 'SAR',
            'cart_amount' => $amount,
            'callback' => $url,
            'return' => $url,
        ])->object();
    }

    public static function checkPayStatus($tran_ref)
    {

        return Http::withHeaders([
            'Authorization' =>  'SHJNLTWBRR-JHWJZ6BKJ2-6BDNRL29TZ',
            'Content-Type' => 'application/json'
        ])->post('https://secure.clickpay.com.sa/payment/query', [
            'profile_id' => '44638',
            'tran_ref' => $tran_ref,
        ])->object();
    }

    public static function createPaymentOperation(Request $request)
    {

        Log::info([$request]);

        $validated = json_decode($request->validated_data, true);

        $data['status'] = false;

        $tran_ref = $request->tranRef;

        if ($request->respStatus == "A") {

            $response =  PaymentCollection::checkPayStatus($tran_ref);

            if ($response && $response->payment_result) {

                $validated['reference'] = $tran_ref;

                UserChargeOperation::create($validated);

                $user = User::where('id', $validated['user_id'])->first();

                $new_balance = $user->current_balance + $validated['amount'];

                $user->update(['current_balance' => $new_balance]);

                $data['status'] = true;
            }
        }

        return $data;
    }
}
