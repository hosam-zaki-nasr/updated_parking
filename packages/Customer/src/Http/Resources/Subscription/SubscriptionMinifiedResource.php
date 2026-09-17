<?php

namespace Customer\Http\Resources\Subscription;

use Customer\Http\Resources\Garage\GarageMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionMinifiedResource extends JsonResource
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

            'user_id' => $this->user_id,

            'amount' => $this->amount,

            'starts_at' => $this->starts_at,

            'ends_at' => $this->ends_at,

            'created_at' => $this->created_at,

            'remaining_days' => $this->remaining_days,

            'auto_renew' => $this->auto_renew,

            'garage' => new GarageMinifiedResource($this->garage),
        ];
    }
}
