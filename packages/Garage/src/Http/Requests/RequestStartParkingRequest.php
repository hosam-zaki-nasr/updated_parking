<?php

namespace Garage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStartParkingRequest extends FormRequest
{
    /**
     * Determine if the company is authorized to make this request.
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

            "QueryDate" => ["bail", "nullable", "string"],

            "VehicleClass" => ["bail", "nullable", "string"],

            "IdentificationType" => ["bail", "required", "string"],

            "IdentificationNumber" => ["bail", "required", "string"],

            "ClientId" => ["bail", "nullable", "uuid", "string"],

            "SiteNumber" => ["bail", "required", "numeric", "exists:garages,site_number"],

            "ParcNumber" => ["bail", "nullable", "numeric"],

            "ZoneNumber" => ["bail", "nullable", "numeric"],
        ];
    }
}
