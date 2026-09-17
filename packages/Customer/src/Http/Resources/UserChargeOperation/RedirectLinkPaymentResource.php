<?php

namespace Customer\Http\Resources\UserChargeOperation;

use Illuminate\Http\Resources\Json\JsonResource;

class RedirectLinkPaymentResource extends JsonResource
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

            'payment_link' => $this['payment_link'],
        ];
    }
}
