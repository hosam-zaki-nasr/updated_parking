<?php

namespace Dashboard\Http\Resources\Country\District;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'governorate_id' => $this->governorate_id,
            'city_id' => $this->city_id,
            'zone_id' => $this->zone_id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'prefix' => $this->prefix,
        ];
    }
}
