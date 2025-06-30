<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Validation\Rules;
use Modules\Core\Http\Requests\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'pin_code' => 'required',
            'phone_number' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required',
        ];
    }
}
