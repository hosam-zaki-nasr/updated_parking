<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientSystemModeDurationCreateRequest extends FormRequest
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

            'client_system_mode_id' => ['bail', 'required', 'string', 'uuid', 'exists:client_system_modes,id', 'max:255'],

            'duration' => ['bail', 'required', 'numeric', 'max:1000'],

            'measurement_unit' => ['bail', 'required', 'string', 'max:255'],
        ];
    }
}
