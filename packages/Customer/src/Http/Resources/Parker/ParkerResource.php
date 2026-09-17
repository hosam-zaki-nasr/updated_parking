<?php

namespace Customer\Http\Resources\Parker;

use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use App\Models\File;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();

        return [

            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'created_at' => $this->created_at,

            'customer' => new CustomerMinifiedResource($this->customer),

            'avatar' => new FileResource(MainRepo::getFile($file)),
        ];
    }
}
