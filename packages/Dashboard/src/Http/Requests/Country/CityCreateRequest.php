<?php

namespace Dashboard\Http\Requests\Country;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [

            "name" => [
                "required", "string", "max:255",
                Rule::unique('countries', 'name')->where('type', CountryType::CITY['code'])
            ],

            "name_ar" => [
                "required", "string", "max:255",
                Rule::unique('countries', 'name_ar')->where('type', CountryType::CITY['code'])
            ],

            "prefix" => ["nullable", "string", "max:255"],

            "longitude" => ["nullable", "string", "max:255"],

            "latitude" => ["nullable", "string", "max:255"],

            "country_id" => [

                "required", "uuid", "string",

                Rule::exists('countries', 'id')->where('type', CountryType::COUNTRY['code'])
            ],

            "governorate_id" => [

                "required", "uuid", "string",

                Rule::exists('countries', 'id')->where('type', CountryType::GOVERNORATE['code'])
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('general_validate.name_is_required'),
            'name.string' => trans('general_validate.name_must_be_string'),
            'name.unique' => trans('general_validate.name_must_be_unique'),

            'name_ar.required' => trans('general_validate.name_ar_is_required'),
            'name_ar.string' => trans('general_validate.name_ar_must_be_string'),
            'name_ar.unique' => trans('general_validate.name_ar_must_be_unique'),

            'prefix.string' => trans('general_validate.prefix_must_be_string'),

            'longitude.string' => trans('general_validate.longitude_must_be_string'),

            'latitude.string' => trans('general_validate.latitude_must_be_string'),

            'country_id.required' => trans('general_validate.country_id_is_required'),
            'country_id.string' => trans('general_validate.country_id_must_be_string'),
            'country_id.uuid' => trans('general_validate.country_id_must_be_valid_uuid'),
            'country_id.exists' => trans('general_validate.country_id_not_exists'),

            'governorate_id.required' => trans('general_validate.governorate_id_is_required'),
            'governorate_id.string' => trans('general_validate.governorate_id_must_be_string'),
            'governorate_id.uuid' => trans('general_validate.governorate_id_must_be_valid_uuid'),
            'governorate_id.exists' => trans('general_validate.governorate_id_not_exists'),
        ];
    }
}
