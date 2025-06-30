<?php

namespace Modules\UserVerification\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class ListUserVerificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
        ];
    }
}
