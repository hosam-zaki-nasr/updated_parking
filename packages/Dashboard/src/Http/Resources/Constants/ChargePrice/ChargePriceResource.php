<?php

namespace Dashboard\Http\Resources\Constants\ChargePrice;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargePriceResource extends JsonResource
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

            'price' => $this->price,
        ];
    }
}
