<?php

namespace Dashboard\Http\Resources\Country\District;

use Dashboard\Http\Resources\Country\City\CityMinifiedResource;
use Dashboard\Http\Resources\Country\CountryMinifiedResource;
use Dashboard\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Dashboard\Http\Resources\Country\Zone\ZoneMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'name' => $this->name,
            'prefix' => $this->prefix,
            'country' => new CountryMinifiedResource($this->country),
            'governorate' => new GovernorateMinifiedResource($this->governorate),
            'city' => new CityMinifiedResource($this->city),
            'zone' => new ZoneMinifiedResource($this->zone),
        ];
    }
}
