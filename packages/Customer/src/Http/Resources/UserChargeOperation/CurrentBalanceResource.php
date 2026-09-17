<?php

namespace Customer\Http\Resources\UserChargeOperation;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentBalanceResource extends JsonResource
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

            'user_id' => $this->id,

            'current_balance' => $this->current_balance,

            'created_at' => $this->created_at,
        ];
    }
}
