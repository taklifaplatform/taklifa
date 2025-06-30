<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdatePhoneNumberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'unique:users,phone_number,'. $this->user()?->id],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
