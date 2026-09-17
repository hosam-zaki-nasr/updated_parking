<?php

namespace Driver\Foundations\Parking;

use App\Foundations\File\FileCreateCollection;
use App\Foundations\LookupType\RequestDriverStatusCollection;
use App\Foundations\LookupType\RequestDriverTypeCollection;
use App\Models\Garage;
use App\Models\Parking;
use App\Models\ParkingFile;
use App\Models\RequestDriver;
use App\Models\User;
use Carbon\Carbon;
use Garage\Foundations\DetermineParkingCollection;

class ParkingCreateCollection
{
    public static function createParking($request)
    {
        $validated = $request->validated();

        $garage = Garage::find(auth()->user()->garage_id);

        $validated['garage_id'] = $garage->id;

        $validated['free_hours'] = $garage->free_hours;

        $validated['hour_cost'] = $garage->valet_cost;

        $validated['start_driver_id'] = auth()->id();

        $validated['starts_at'] = Carbon::now();

        $validated['user_id'] = User::where('id', $validated['user_id'])->orWhere('qr_id', $validated['user_id'])->first()->id;

        $parking = self::validateParkingExists($validated['garage_id'], $validated['user_id']);

        if ($parking['status'] == false) {

            return $parking;
        }

        $parking = Parking::create($validated);

        self::updateStartRequestStatus($parking);

        if (isset($validated['files'])) {

            foreach ($validated['files'] as $file) {

                $data['file'] = $file;

                $file = FileCreateCollection::createFile($data);

                ParkingFile::create([
                    "file_id" => $file->id,
                    "parking_id" => $parking->id,
                    "creator_id" => auth()->id(),
                ]);
            }
        }

        return $parking;
    }

    public static function validateParkingExists(
        $garage_id,
        $user_id,
    ) {

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

    public static function updateStartRequestStatus(Parking $parking)
    {
        $start_parking_type_id = RequestDriverTypeCollection::startParking()->id;

        $accepted_status_id = RequestDriverStatusCollection::accepted()->id;

        $requestDriver = RequestDriver::where('garage_id', $parking->garage_id)

            ->where('user_id', $parking->user_id)

            ->where('status_id', $accepted_status_id)

            ->where('type_id', $start_parking_type_id)

            ->where('parking_id', null)

            ->first();

        $requestDriver->parking_id = $parking->id;
    }
}
