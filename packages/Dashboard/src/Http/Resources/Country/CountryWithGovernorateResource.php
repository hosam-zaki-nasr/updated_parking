<?php

namespace Dashboard\Http\Resources\Country;

use Dashboard\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryWithGovernorateResource extends JsonResource
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
            'phone_code' => $this->phone_code,
            'flag' => $this->flag,
            'prefix' => $this->prefix,
            'governorates' => GovernorateMinifiedResource::collection($this->governorates),
        ];
    }
}
