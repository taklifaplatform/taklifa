<?php

namespace Modules\Auth\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class CheckEmailExistRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ];
    }
}
