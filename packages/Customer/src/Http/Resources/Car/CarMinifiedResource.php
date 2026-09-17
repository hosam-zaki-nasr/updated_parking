<?php

namespace Customer\Http\Resources\Car;

use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use App\Models\File;
use Dashboard\Http\Resources\Constants\CarColor\CarColorMinifiedResource;
use Dashboard\Http\Resources\Constants\CarType\CarTypeMinifiedResource;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_CAR_IMAGE['key'])->first();

        return [

            'id' => $this->id,

            'name' => $this->name,

            'number' => $this->number,

            'text' => $this->text,

            'full_number' => $this->full_number,

            'random_code' => $this->random_code,

            'created_at' => $this->created_at,

            'color' => new CarColorMinifiedResource($this->carColor),

            'type' => new CarTypeMinifiedResource($this->carType),

            'image' => new FileResource(MainRepo::getFile($file)),

            'customer' => new CustomerMinifiedResource($this->creator),
        ];
    }
}
