<?php

namespace Dashboard\Http\Resources\Report\Garage;

use App\Http\Resources\SystemLookupResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GarageResource extends JsonResource
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

            'vip_cost' => $this->vip_cost,

            'valet_cost' => $this->valet_cost,

            'fine_cost' => $this->fine_cost,

            'max_car_count' => $this->max_car_count,

            'free_hours' => $this->free_hours,

            'longitude' => $this->longitude,

            'latitude' => $this->latitude,

            'open_at' => Carbon::parse(Carbon::today()->format('y-m-d') . ' ' . $this->open_at),

            'close_at' => Carbon::parse(Carbon::today()->format('y-m-d') . ' ' . $this->close_at),

            'creator_id' => $this->creator_id,

            'created_at' => $this->created_at,

            'type' => new SystemLookupResource($this->type),

            'total_profit' => $this->parking->sum('total_cost')

        ];
    }
}
