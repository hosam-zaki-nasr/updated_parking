<?php

namespace Garage\Http\Resources;

use Customer\Http\Resources\Car\CarMinifiedResource;
use Dashboard\Http\Resources\Garage\GarageMinifiedResource;
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

            'ends_at' => $this->ends_at,

            'total_cost' => $this->total_cost ? $this->total_cost : 0,

            'hour_cost' => $this->hour_cost,

            'free_hours' => $this->free_hours,

            'user_id' => $this->user_id,

            'garage' => new GarageMinifiedResource($this->garage),

            'car' => new CarMinifiedResource($this->car),
        ];
    }
}
