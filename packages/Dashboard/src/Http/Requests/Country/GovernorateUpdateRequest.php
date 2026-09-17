<?php

namespace Dashboard\Http\Requests\Country;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GovernorateUpdateRequest extends FormRequest
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

            "name" => [
                "nullable", "string", "max:255",

                Rule::unique('countries', 'name')->where('type', CountryType::GOVERNORATE['code'])->ignore($request->governorate->id, 'id')
            ],

            "name_ar" => [
                "nullable", "string", "max:255",

                Rule::unique('countries', 'name_ar')->where('type', CountryType::GOVERNORATE['code'])->ignore($request->governorate->id, 'id')
            ],

            "prefix" => ["nullable", "string", "max:255"],

            "longitude" => ["nullable", "string", "max:255"],

            "latitude" => ["nullable", "string", "max:255"]
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => trans('general_validate.name_must_be_string'),
            'name.unique' => trans('general_validate.name_must_be_unique'),

            'name_ar.string' => trans('general_validate.name_ar_must_be_string'),
            'name_ar.unique' => trans('general_validate.name_ar_must_be_unique'),

            'prefix.string' => trans('general_validate.prefix_must_be_string'),

            'longitude.string' => trans('general_validate.longitude_must_be_string'),

            'latitude.string' => trans('general_validate.latitude_must_be_string'),

        ];
    }
}
