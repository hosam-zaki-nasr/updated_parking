<?php

namespace Garage\Foundations;

use App\Constants\HasLookupType\UserAccountType;
use App\Constants\IdentificationType;
use App\Models\Garage;
use App\Models\Parking;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use App\Constants\SystemDefault;

class ParkingEndCollection
{
    public static function endParking($request)
    {
        $validated = $request->validated();

        $garage = Garage::where('site_number', $validated['SiteNumber'])->first();

        $car_number = $validated['IdentificationType'] == IdentificationType::LICENSE_PALET['name'] ? $validated['IdentificationNumber'] : -1;

        $user_id = $validated['IdentificationType'] == IdentificationType::QR_CODE['name'] ? $validated['IdentificationNumber'] : -1;

        if ($car_number != -1) {

            $car = RequestEndParkingCollection::validateCarExists($car_number);

            if ($car['status'] == false) {

                return $car;
            }

            $user_id = $car['data']->creator_id;

            $validated['car_id'] = $car['data']->id;
        } elseif ($user_id != -1) {

            $user = RequestEndParkingCollection::validateUserExists($user_id);

            if ($user['status'] == false) {

                return $user;
            }

            $user = $user['data'];

            $user_id = $user->id;
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
            $user_id
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

        $parkStatus = self::calckParkedHoursAndEndPark($parking);

        if (isset($parkStatus['status']) && $parkStatus['status'] == false) {

            return $parkStatus;
        }

        $parking->update($validated);

        return [
            "Status" => "Authorized"
        ];
    }

    public static function calckParkedHoursAndEndPark(Parking $parking)
    {
        // $parking->starts_at = Carbon::parse("2025-04-28 19:55:51");
        // $parking->ends_at = Carbon::parse("2025-04-28 20:15:02");


        $parking->ends_at = Carbon::now();

        $start  = Carbon::parse($parking->starts_at);

        $minutes = $start->diffInMinutes($parking->ends_at);

        $hours = $minutes / 60;

        //->setTimezone('Asia/Riyadh')
        // dd(
        //     ["end"=>$end->format('Y-m-d H:i:s')],
        //     ["start"=>$start->format('Y-m-d H:i:s')],
        //     [$minutes/60],
        //     ["minutes"=>$minutes],
        //     ["end_timezone"=>$end->timezone],
        //     ["start_timezone"=>$start->timezone]
        // );

        // dd($parking->garage->hour_cost);
        // dd($hours);

        if ($minutes < 5) {
            //calc free minutes
            $parking->total_cost = 0;
        } else {

            $totalCost = $hours * $parking->garage->hour_cost;

            $parking->total_cost = round($totalCost, SystemDefault::DEFAULT_NUMBER_ROUND_DIGITS);
        }

        // dd($parking->total_cost);

        // $financeStatus = self::validateIfHasSubscriptionOrNotEmptyWallet($parking->user, $parking->garage, $hours);

        // if ($financeStatus['status'] == false) {

        //     return $financeStatus;
        // }


        $financeStatus = self::validateIfHasSubscription($parking->user, $parking->garage, $hours);

        if ($financeStatus['status'] == true) {

            $parking->total_cost = 0;

            $parking->save();

            return $parking;
        } else {

            $financeStatus = self::validateIfNotEmptyWallet($parking->user, $parking->garage, $hours);

            if ($financeStatus['status'] == true) {

                $parking->save();

                $new_balance = $parking->user->current_balance - $parking->total_cost;

                User::where('id', $parking->user_id)->update(['current_balance' => $new_balance]);

                return $parking;
            }
        }

        return $financeStatus;
    }


    public static function validateIfHasSubscriptionOrNotEmptyWallet(User $user, Garage $garage, $hours)
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

            if ($user->current_balance < ($garage->hour_cost * $hours)) {

                $errors = $errors + 1;
            }
        } elseif ($user->accountType->code == UserAccountType::CONTACT['code']) {

            if ($user->customer->current_balance < ($garage->hour_cost * $hours)) {

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

    public static function validateIfHasSubscription(User $user, Garage $garage, $hours)
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

        if ($errors === 1) {

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

    public static function validateIfNotEmptyWallet(User $user, Garage $garage, $hours)
    {
        $errors = 0;

        if ($user->accountType->code == UserAccountType::CUSTOMER['code']) {

            if ($user->current_balance < ($garage->hour_cost * $hours)) {

                $errors = $errors + 1;
            }
        } elseif ($user->accountType->code == UserAccountType::CONTACT['code']) {

            if ($user->customer->current_balance < ($garage->hour_cost * $hours)) {

                $errors = $errors + 1;
            }
        }

        if ($errors === 1) {

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
