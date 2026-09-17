<?php

namespace Garage\Foundations;

use App\Constants\IdentificationType;
use App\Models\Car;
use App\Models\Garage;
use App\Models\User;
use Garage\Http\Requests\RequestEndParkingRequest;

class RequestEndParkingCollection
{
    public static function requestEndParking(RequestEndParkingRequest $request)
    {
        $validated = $request->validated();

        $garage = Garage::where('site_number', $validated['SiteNumber'])->first();

        $car_number = $validated['IdentificationType'] == IdentificationType::LICENSE_PALET['name'] ? $validated['IdentificationNumber'] : -1;

        $user_id = $validated['IdentificationType'] == IdentificationType::QR_CODE['name'] ? $validated['IdentificationNumber'] : -1;

        if ($car_number != -1) {

            $car = self::validateCarExists($car_number);

            if ($car['status'] == false) {

                return $car;
            }

            $user = $car['data']->creator;
        } elseif ($user_id != -1) {

            $user = self::validateUserExists($user_id);

            if ($user['status'] == false) {

                return $user;
            }

            $user = $user['data'];
        } else {

            return [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'AccessRefused',
                ],
            ];
        }

        $parking = DetermineParkingCollection::determineParkedCar(
            $garage->id,
            $user->id
        );

        if (!$parking) {

            return [
                'status' => false,
                'error_response' => [
                    'Status' => 'Unauthorized',
                    'UnauthorizedReason' => 'WrongCycle',
                ],
            ];
        }

        return [
            "Status" => "Authorized",
            "MaxAmount" => $user->userChargeOperations->sum('amount'),
            "ImmediatePayment" => false,
        ];
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
}
