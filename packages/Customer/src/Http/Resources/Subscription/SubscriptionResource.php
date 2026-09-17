<?php

namespace Customer\Http\Resources\Subscription;

use Customer\Http\Resources\Garage\GarageMinifiedResource;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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

            'user' => new CustomerMinifiedResource($this->user),

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
