<?php

namespace Customer\Http\Resources\Parking;

use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingFileResource extends JsonResource
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
            'parking_id' => $this->parking_id,
            'file' => $this->file,
            'file' => new FileResource(MainRepo::getFile($this->file))
        ];
    }
}
