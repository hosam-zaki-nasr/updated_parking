<?php

namespace Driver\Foundations\RequestDriver;

use App\Foundations\LookupType\RequestDriverStatusCollection;

class RequestDriverCollection
{
    public static function acceptRequestDriver($requestDriver)
    {

        if ($requestDriver->status_id == RequestDriverStatusCollection::pending()->id) {

            $requestDriver->status_id = RequestDriverStatusCollection::accepted()->id;

            $requestDriver->driver_id = auth()->id();

            $requestDriver->save();

            if ($requestDriver->parking) {
                $requestDriver->parking()->update(['end_driver_id' => auth()->id()]);
            }

            return $requestDriver;
        }

        return false;
    }

    public static function disacceptRequestDriver($requestDriver, $reasone)
    {

        if ($requestDriver->driver_id == auth()->id()) {

            // $requestDriver->status_id = RequestDriverStatusCollection::pending()->id;
            $requestDriver->status_id = RequestDriverStatusCollection::canceled()->id;
            $requestDriver->details = $reasone;
            $requestDriver->canceler_id = auth()->id();

            $requestDriver->save();

            return $requestDriver;
        }

        return false;
    }
}
