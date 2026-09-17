<?php

namespace Dashboard\Http\Resources\Advertisement;

use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementMinifiedResource extends JsonResource
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

            'title' => $this->title,

            'details' => $this->details,

            'amount' => $this->amount,

            'link' => $this->link,

            'client_name' => $this->client_name,

            'client_phone' => $this->client_phone,

            'client_field' => $this->client_field,

            'starts_at' => $this->starts_at,

            'ends_at' => $this->ends_at,

            'created_at' => $this->created_at,

            'image' => new FileResource(MainRepo::getFile($this->file)),

        ];
    }
}
