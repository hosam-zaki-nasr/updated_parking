<?php

namespace Dashboard\Http\Requests\Garage;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GarageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {

        return [

            "name" => ["bail", "required", "string", "max:255"],

            "name_ar" => ["bail", "required", "string", "max:255"],

            // "type_id" => ["bail", "required", "string", "uuid", "exists:system_lookups,id"],

            "site_number" => [

                "bail",
                "required",
                "numeric",

                Rule::unique('garages', 'site_number')
                ->whereNull('deleted_at')
                ->ignore($request->garage->site_number, 'site_number')
            ],

            "max_car_count" => ["bail", "required", "numeric", "max:100000"],

            "open_at" => ["bail", "required", "string", "date_format:H:i"],

            "close_at" => ["bail", "required", "string", "date_format:H:i"],

            "hour_cost" => ["bail", "nullable", "numeric", "max:100000"],

            "free_hours" => ["bail", "nullable", "numeric", "max:100000"],

            "vip_cost" => ["bail", "nullable", "numeric", "max:100000"],

            "valet_cost" => ["bail", "nullable", "numeric", "max:100000"],

            "fine_cost" => ["bail", "nullable", "numeric", "max:100000"],

            "longitude" => ["bail", "nullable", "numeric", "max:100000"],

            "latitude" => ["bail", "nullable", "numeric", "max:100000"],

            "subscription_price" => ["bail", "nullable", "numeric", "max:100000"],

            "country_id" => [

                "nullable",
                "uuid",
                "string",

                Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            ],

            "governorate_id" => [

                "nullable",
                "uuid",
                "string",

                Rule::exists('countries', 'id')->where('type', CountryType::GOVERNORATE['code'])
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),

            'name_ar.required' => trans('general_validate.name_ar_is_required'),
            'name_ar.string' => trans('general_validate.name_ar_must_be_string'),

            'type_id.required' => trans('general_validate.type_id_is_required'),
            'type_id.string' => trans('general_validate.type_id_must_be_string'),
            'type_id.uuid' => trans('general_validate.type_id_must_be_valid_uuid'),
            'type_id.exists' => trans('general_validate.type_id_not_exists'),

            'site_number.required' => trans('general_validate.site_number_is_required'),
            'site_number.numeric' => trans('general_validate.site_number_must_be_numeric'),
            'site_number.unique' => trans('general_validate.site_number_must_be_unique'),

            'max_car_count.required' => trans('general_validate.max_car_count_is_required'),
            'max_car_count.numeric' => trans('general_validate.max_car_count_must_be_numeric'),

            'hour_cost.required' => trans('general_validate.hour_cost_is_required'),
            'hour_cost.numeric' => trans('general_validate.hour_cost_must_be_numeric'),

            'open_at.required' => trans('general_validate.open_at_is_required'),
            'open_at.string' => trans('general_validate.open_at_must_be_string'),
            'open_at.date_format' => trans('general_validate.open_at_date_format_must_be_H_I'),

            'close_at.required' => trans('general_validate.close_at_is_required'),
            'close_at.string' => trans('general_validate.close_at_must_be_string'),
            'close_at.date_format' => trans('general_validate.close_at_date_format_must_be_H_I'),

            'free_hours.numeric' => trans('general_validate.free_hours_must_be_numeric'),
            'vip_cost.numeric' => trans('general_validate.vip_cost_must_be_numeric'),
            'valet_cost.numeric' => trans('general_validate.valet_cost_must_be_numeric'),
            'fine_cost.numeric' => trans('general_validate.fine_cost_must_be_numeric'),
            'longitude.string' => trans('general_validate.longitude_must_be_string'),
            'latitude.string' => trans('general_validate.latitude_must_be_string'),

        ];
    }
}
