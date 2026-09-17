<?php

namespace App\Http\Resources;

use App\Models\User;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Dashboard\Http\Resources\ValetDriver\ValetDriverMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $content_data = json_decode($this->data);

        $resource =  [

            'id' => $this->id,
            'event_id' => $this->event_id,

            'module_code' => $this->module_code,
            'module_prefix' => $this->module_prefix,
            'module_name' => $this->module_name,
            'module_name_ar' => $this->module_name_ar,

            'event_action' => $this->event_action,
            'event_table_name' => $this->event_table_name,
            'event_code' => $this->event_code,
            'event_prefix' => $this->event_prefix,
            'event_name' => $this->event_name,
            'event_name_ar' => $this->event_name_ar,
            'event_content' => $this->event_content,
            'event_content_ar' => $this->event_content_ar,
            'event_reference_code' => $this->event_reference_code,

            'occurred_at' => $this->occurred_at,
            'watched_at' => $this->watched_at,
            'created_at' => $this->created_at,
            'customer' => isset($content_data->CUSTOMER_ID) ? new CustomerMinifiedResource(User::find($content_data->CUSTOMER_ID)) : null,
            'driver' => isset($content_data->DRIVER_ID) ? new ValetDriverMinifiedResource(User::find($content_data->DRIVER_ID)) : null,
            // 'data' => $content_data,
        ];

        return $resource;
    }
}
