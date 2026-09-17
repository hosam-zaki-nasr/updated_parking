<?php

namespace App\Http\Resources\Auth;

use App\Constants\FileModuleType;
use App\Foundations\File\MainRepo;
use App\Http\Resources\FileResource;
use App\Http\Resources\SystemLookupResource;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $file = $this->file ? $this->file : File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();

        return [
            'id' => $this->id,

            'qr_id' => $this->qr_id,

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'gender' => $this->gender,

            'birthday' => $this->birthday,

            'is_verified' => $this->mobile_verification_code ? false : true,

            'is_completed' => $this->isCompleted ? true : false,

            'token' => $this->api_token,

            'created_at' => $this->created_at,

            'avatar' => new FileResource(MainRepo::getFile($file)),

            'account_type' => new SystemLookupResource($this->accountType),

        ];
    }
}
