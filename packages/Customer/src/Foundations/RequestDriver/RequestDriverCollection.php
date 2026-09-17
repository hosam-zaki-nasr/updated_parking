<?php

namespace Customer\Foundations\RequestDriver;

use App\Foundations\LookupType\RequestDriverStatusCollection;
use App\Foundations\LookupType\RequestDriverTypeCollection;
use App\Models\RequestDriver;

class RequestDriverCollection
{
    public static function createRequestDriverStart($request)
    {

        $start_parking_type_id = RequestDriverTypeCollection::startParking()->id;

        $pending_status_id = RequestDriverStatusCollection::pending()->id;

        $validated = $request->validated();

        $requestDriver = RequestDriver::where('garage_id', $validated['garage_id'])

            ->where('user_id', auth()->id())

            ->where('status_id', $pending_status_id)

            ->where('type_id', $start_parking_type_id)

            ->first();

        if ($requestDriver) {

            $requestDriver->repeated_times = ++$requestDriver->repeated_times;

            $requestDriver->save();
        } else {

            $accepted_status_id = RequestDriverStatusCollection::accepted()->id;

            $requestDriver = RequestDriver::where('garage_id', $validated['garage_id'])

                ->where('user_id', auth()->id())

                ->where('status_id', $accepted_status_id)

                ->where('type_id', $start_parking_type_id)

                ->where('parking_id', null)

                ->first();

            if (empty($requestDriver)) {

                $validated['type_id'] = $start_parking_type_id;

                $requestDriver = RequestDriver::create($validated);
            }
        }

        return $requestDriver;
    }

    public static function createRequestDriverEnd($request)
    {

        $end_parking_type_id = RequestDriverTypeCollection::endParking()->id;

        $pending_status_id = RequestDriverStatusCollection::pending()->id;

        $validated = $request->validated();

        $requestDriver = RequestDriver::where('parking_id', $validated['parking_id'])

            ->where('type_id', $end_parking_type_id)

            ->first();

        if ($requestDriver) {

            if ($requestDriver->status_id == $pending_status_id) {

                $requestDriver->repeated_times = ++$requestDriver->repeated_times;

                $requestDriver->save();
            }
        } else {

            $validated['type_id'] = $end_parking_type_id;

            $requestDriver = RequestDriver::create($validated);
        }

        return $requestDriver;
    }
}
