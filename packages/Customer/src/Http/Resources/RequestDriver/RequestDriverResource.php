<?php

namespace Customer\Http\Resources\RequestDriver;

use App\Http\Resources\SystemLookupResource;
use Customer\Http\Resources\Parker\ParkerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestDriverResource extends JsonResource
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

            'reasone' => $this->details,

            'parking_id' => $this->parking_id,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

            'repeated_times' => $this->repeated_times,

            'user_longitude' => $this->longitude,

            'user_latitude' => $this->latitude,

            'type' => new SystemLookupResource($this->type),

            'status' => new SystemLookupResource($this->status),

            'user' => new ParkerMinifiedResource($this->user),
        ];
    }
}
