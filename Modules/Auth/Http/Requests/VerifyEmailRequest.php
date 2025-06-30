<?php

namespace Modules\Auth\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'pin_code' => 'required',
            'email' => 'required|email|exists:users,email',
        ];
    }
}
