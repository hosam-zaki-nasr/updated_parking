<?php

namespace Dashboard\Http\Resources\Report\Garage;

use App\Http\Resources\SystemLookupResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GarageMinifiedResource extends JsonResource
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

            'name' => $this->name,

            'name_ar' => $this->name_ar,

            'site_number' => $this->site_number,

            'hour_cost' => $this->hour_cost,

            'max_car_count' => $this->max_car_count,

            'available_car_count' => $this->available_car_count,

            'reserved_car_count' => $this->reserved_car_count,

            'longitude' => $this->longitude,

            'latitude' => $this->latitude,

            'open_at' => Carbon::today()->format('y-m-d') . ' ' . $this->open_at,

            'close_at' => Carbon::today()->format('y-m-d') . ' ' . $this->close_at,

            'is_available' => $this->is_available,

            'type' => new SystemLookupResource($this->type),

            'total_profit' => $this->parking->sum('total_cost')
        ];
    }
}
