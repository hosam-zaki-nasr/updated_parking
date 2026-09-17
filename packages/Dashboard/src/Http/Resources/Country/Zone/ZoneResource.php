<?php

namespace Dashboard\Http\Resources\Country\Zone;

use Dashboard\Http\Resources\Country\City\CityMinifiedResource;
use Dashboard\Http\Resources\Country\CountryMinifiedResource;
use Dashboard\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
        ];
    }
}
