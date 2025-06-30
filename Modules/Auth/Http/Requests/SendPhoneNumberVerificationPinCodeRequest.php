<?php

namespace Modules\Auth\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class SendPhoneNumberVerificationPinCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number' => 'required|exists:users,phone_number',
        ];
    }
}
