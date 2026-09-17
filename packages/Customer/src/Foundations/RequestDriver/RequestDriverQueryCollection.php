<?php

namespace Customer\Foundations\RequestDriver;

use App\Models\RequestDriver;

class RequestDriverQueryCollection
{
    public static function searchAllRequestDrivers(
        $status_id = -1,
        $driver_id = -1,
    ) {
        return RequestDriver::where('user_id', auth()->id())

            ->where(function ($q) use ($status_id, $driver_id) {

                if ($status_id && $status_id != -1) {

                    $q
                        ->where('status_id', $status_id);
                }

                if ($driver_id && $driver_id != -1) {

                    $q
                        ->where('driver_id', $driver_id);
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
