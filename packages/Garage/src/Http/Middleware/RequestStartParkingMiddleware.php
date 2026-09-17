<?php

namespace Garage\Http\Middleware;

use App\Constants\HasLookupType\UserAccountType;
use App\Constants\IdentificationType;
use App\Constants\StatusCode;
use App\Models\Car;
use App\Models\Garage;
use App\Models\Subscription;
use App\Models\User;
use Closure;
use Garage\Foundations\DetermineParkingCollection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RequestStartParkingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $error_message = "There are some important fields required.";

        $validated = $request->all();

        if (
            !isset($validated['SiteNumber']) ||
            !isset($validated['IdentificationType']) ||
            !isset($validated['IdentificationNumber'])
        ) {
            return response()->error(
                $error_message,
                $error_message,
                StatusCode::BAD_REQUEST
            );
        }

        $garage = Garage::where('site_number', $validated['SiteNumber'])->first();

        $car_number = $validated['IdentificationType'] == IdentificationType::LICENSE_PALET['name'] ? $validated['IdentificationNumber'] : -1;

        $user_id = $validated['IdentificationType'] == IdentificationType::QR_CODE['name'] ? $validated['IdentificationNumber'] : -1;


        if ($car_number != -1) {

            $car = self::validateCarExists($car_number);

            if ($car['status'] == false) {

                return response()->json($car, StatusCode::OK);
            }
            $car = $car['data'];
            $user_id = $car->creator_id;
        } elseif ($user_id != -1) {

            $user = self::validateUserExists($user_id);

            if ($user['status'] == false) {

                return response()->json($user, StatusCode::OK);
            }
            $user_id = $user['data']->id;
        } else {

            return response()->json([
                "status" => false,
                "error_response" => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'AccessRefused',
                ],

            ], StatusCode::OK);
        }

        $parking = self::validateParkingExists($garage->id, $user_id);

        if ($parking['status'] == false) {

            return response()->json($parking, StatusCode::OK);
        }

        $user = User::find($user_id);

        $financeStatus = self::validateIfHasSubscriptionOrNotEmptyWallet($user, $garage);

        if ($financeStatus['status'] == false) {

            return response()->json($financeStatus, StatusCode::OK);
        }

        $request->attributes->add([
            'middleware_data' => [
                'user' => $user,
                'car' => isset($car) ? $car : null,
                'garage' => $garage,
            ],
        ]);

        return $next($request);
    }

    public static function validateCarExists(string $car_number)
    {
        $car = Car::where('full_number', $car_number)->first();

        $data = [
            'status' => true,
            'data' => $car
        ];

        if (!$car) {

            $data = [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'UnknownIdentification',
                ],
            ];
        }

        return $data;
    }

    public static function validateUserExists(string $qr_id)
    {
        $user = User::where('id', $qr_id)->orWhere('qr_id', $qr_id)->first();

        $data = [
            'status' => true,
            'data' => $user
        ];

        if (!$user) {

            $data = [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'UnknownIdentification',
                ],
            ];
        }

        return $data;
    }

    public static function validateParkingExists(string $garage_id, string $user_id)
    {

        $parking = DetermineParkingCollection::determineParkedCar(
            $garage_id,
            $user_id
        );

        $data = [
            'status' => true,
            'data' => $parking
        ];

        if ($parking) {

            $data = [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'WrongCycle',
                ],
            ];
        }

        return $data;
    }

    public static function validateIfHasSubscriptionOrNotEmptyWallet(User $user, Garage $garage)
    {
        $errors = 0;

        $subscription = Subscription::where('user_id', $user->id)->where('garage_id', $garage->id)->latest()->first();

        if ($user->accountType->code == UserAccountType::CUSTOMER['code']) {

            if (($subscription && $subscription->isEnded) or $subscription == null) {
                $errors = $errors + 1;
            }
        } else {

            $errors = $errors + 1;
        }

        if ($user->accountType->code == UserAccountType::CUSTOMER['code']) {

            if ($user->current_balance < $garage->hour_cost) {

                $errors = $errors + 1;
            }
        } elseif ($user->accountType->code == UserAccountType::CONTACT['code']) {

            if ($user->customer->current_balance < $garage->hour_cost) {

                $errors = $errors + 1;
            }
        }

        if ($errors == 2) {

            return [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'MaxAmountReached',
                ],
            ];
        } else {
            return [
                'status' => true
            ];
        }
    }
}
