<?php

namespace Dashboard\Http\Requests\Country;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryCreateRequest extends FormRequest
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
                Rule::unique('countries', 'name')->where('type', CountryType::COUNTRY['code'])
            ],

            "name_ar" => [
                "required", "string", "max:255",
                Rule::unique('countries', 'name_ar')->where('type', CountryType::COUNTRY['code'])
            ],

            "phone_code" => ["required", "string", "max:5"],

            "flag" => ["nullable", "string", "max:255"],

            "prefix" => ["nullable", "string", "max:255"],

            "longitude" => ["nullable", "string", "max:255"],

            "latitude" => ["nullable", "string", "max:255"],

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

            'phone_code.required' => trans('general_validate.phone_code_is_required'),
            'phone_code.string' => trans('general_validate.phone_code_must_be_string'),

            'flag.string' => trans('general_validate.flag_must_be_string'),

            'prefix.string' => trans('general_validate.prefix_must_be_string'),

            'longitude.string' => trans('general_validate.longitude_must_be_string'),

            'latitude.string' => trans('general_validate.latitude_must_be_string'),

        ];
    }
}
