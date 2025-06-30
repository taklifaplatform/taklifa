<?php

namespace Modules\Auth\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
