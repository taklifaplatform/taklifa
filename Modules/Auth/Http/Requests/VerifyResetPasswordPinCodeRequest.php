<?php

namespace Modules\Auth\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class VerifyResetPasswordPinCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'pin_code' => 'required',
            'phone_number' => 'required',
        ];
    }
}
