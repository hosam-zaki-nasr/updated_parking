<?php

namespace Dashboard\Http\Resources\Customer;

use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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

            'qr_id' => $this->qr_id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'current_balance' => $this->current_balance,

            'has_active_subscription' => $this->has_active_subscription,

            'created_at' => $this->created_at,

            'avatar' => new FileResource(MainRepo::getFile($file)),

            'contacts' =>  UserMinifiedResource::collection($this->contacts),

        ];
    }
}
