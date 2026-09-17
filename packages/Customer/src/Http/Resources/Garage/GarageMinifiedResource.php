<?php

namespace Customer\Http\Resources\Garage;

use App\Http\Resources\SystemLookupResource;
use Carbon\Carbon;
use Dashboard\Http\Resources\Country\CountryMinifiedResource;
use Dashboard\Http\Resources\Country\Governorate\GovernorateMinifiedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GarageMinifiedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $garage_name = app()->getLocale() == 'ar' ?  $this->name_ar : $this->name;
        $monthely_subscription = app()->getLocale() == 'ar' ? "رسوم الاشتراك الشهري" : "Monthly Subscription Fee";

        return [

            'id' => $this->id,

            'name' => app()->getLocale() == 'ar' ?  $this->name_ar : $this->name,

            'site_number' => $this->site_number,

            'hour_cost' => $this->hour_cost,

            'max_car_count' => $this->max_car_count,

            'available_car_count' => $this->available_car_count,

            'reserved_car_count' => $this->reserved_car_count,

            'longitude' => $this->longitude,

            'latitude' => $this->latitude,

            'open_at' => Carbon::parse(Carbon::today()->format('y-m-d') . ' ' . $this->open_at),

            'close_at' => Carbon::parse(Carbon::today()->format('y-m-d') . ' ' . $this->close_at),

            'is_available' => $this->is_available,

            'type' => new SystemLookupResource($this->type),

            'subscription_price' => $this->subscription_price,

            'country' => new CountryMinifiedResource($this->country),

            'governorate' => new GovernorateMinifiedResource($this->governorate),

            // 'distance' => $this->whenHas('distance', function ($distance) {
            //     return round($distance / 1000, 3);
            // }),
        ];
    }
}
