<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\SystemLookupResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserNotificationTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'notification_token' => $this->notification_token,
            // 'type' => new SystemLookupResource($this->notificationType),
            'created_at' => $this->created_at,
        ];
    }
}
