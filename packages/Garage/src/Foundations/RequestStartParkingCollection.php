<?php

namespace Garage\Foundations;

use Garage\Http\Requests\RequestStartParkingRequest;

class RequestStartParkingCollection
{
    public static function requestStartParking(RequestStartParkingRequest $request)
    {
        $data = $request->attributes->get('middleware_data');

        return [
            'Status' => 'Authorized',
            'ClientId' => $data['user']->id,
            'LicensePlates' => [isset($data['car']) && $data['car'] ? $data['car']->full_number : ''],
            'QRCodes' => [$data['user']->qr_id],
        ];
    }
}
