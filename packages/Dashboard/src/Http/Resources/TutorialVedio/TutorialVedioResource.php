<?php

namespace Dashboard\Http\Resources\TutorialVedio;

use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorialVedioResource extends JsonResource
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

            'vedio' => new FileResource(MainRepo::getFile($this->file)),
        ];
    }
}
