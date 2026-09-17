<?php

namespace Dashboard\Http\Resources\Country\Governorate;

use Dashboard\Http\Resources\Country\City\CityMinifiedResource;
use Dashboard\Http\Resources\Country\CountryMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateWithCityResource extends JsonResource
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
            'cities' => CityMinifiedResource::collection($this->cities),
        ];
    }
}
