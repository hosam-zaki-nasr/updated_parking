<?php

namespace Dashboard\Http\Resources\Subscription;

use App\Http\Resources\Auth\UserMinifiedResource;
use Customer\Http\Resources\Garage\GarageMinifiedResource;
use Customer\Http\Resources\Car\CarMinifiedResource;
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

            'is_active' => $this->is_ended ? false : true,

            'deleted_at' => $this->deleted_at,

            'garage' => new GarageMinifiedResource($this->garage),

            'user' =>  new UserMinifiedResource($this->user),

            'cars' => CarMinifiedResource::collection($this->user->cars),
        ];
    }
}
