<?php

namespace App\Http\Requests\Auth;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MobileVerificationRequest extends FormRequest
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

            "mobile_verification_code" => [
                "required",
                "string",
                "max:4",

                Rule::exists('users', 'mobile_verification_code')

                    ->where(function (Builder $query) use ($request) {

                        return $query->where([

                            'mobile_verification_code' => $request->mobile_verification_code,

                        ]);
                    }),
            ],
        ];
    }
}
