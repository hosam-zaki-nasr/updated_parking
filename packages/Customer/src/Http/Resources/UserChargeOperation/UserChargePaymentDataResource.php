<?php

namespace Customer\Http\Resources\UserChargeOperation;

use Illuminate\Http\Resources\Json\JsonResource;

class UserChargePaymentDataResource extends JsonResource
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

            'payment_link' => url('https://www.google.com.eg/'),
        ];
    }
}
