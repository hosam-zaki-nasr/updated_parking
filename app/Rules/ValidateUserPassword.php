<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ValidateUserPassword implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $user = User::where('phone', Request('user'))->orWhere('email', Request('user'))->first();

        return !empty($user) && Hash::check($value, $user->password) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {

        return trans('general_validate.passowrd_is_invalid');
    }
}
