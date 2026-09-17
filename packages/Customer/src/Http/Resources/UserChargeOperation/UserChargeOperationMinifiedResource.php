<?php

namespace Customer\Http\Resources\UserChargeOperation;

use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserChargeOperationMinifiedResource extends JsonResource
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

            'amount' => $this->amount,

            'user' => new CustomerMinifiedResource($this->user),

            'created_at' => $this->created_at,
        ];
    }
}
