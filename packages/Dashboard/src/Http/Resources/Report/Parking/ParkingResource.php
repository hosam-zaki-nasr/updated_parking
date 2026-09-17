<?php

namespace Dashboard\Http\Resources\Report\Parking;

use Customer\Http\Resources\Car\CarMinifiedResource;
use Customer\Http\Resources\Garage\GarageMinifiedResource;
use Customer\Http\Resources\Parker\ParkerMinifiedResource;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [

            'id' => $this->id,

            'starts_at' => $this->starts_at,

            'start_confirmed_at' => $this->start_confirmed_at,

            'ends_at' => $this->ends_at,

            'force_closed' => $this->force_closed ? true : false,

            'total_cost' => $this->total_cost ? $this->total_cost : 0,

            'hour_cost' => $this->hour_cost,

            'free_hours' => $this->free_hours,

            'start_longitude' => $this->longitude,

            'start_latitude' => $this->latitude,

            'end_longitude' => $this->requestDriver ? $this->requestDriver->longitude : null,

            'end_latitude' => $this->requestDriver ? $this->requestDriver->latitude : null,

            'has_end_request' => $this->requestDriver ? true : false,

            'user' => new CustomerMinifiedResource($this->user),

            'start_driver' => new ParkerMinifiedResource($this->startDriver),

            'end_driver' => new ParkerMinifiedResource($this->endDriver),

            'garage' => new GarageMinifiedResource($this->garage),

            'car' => new CarMinifiedResource($this->car),
        ];
    }
}
