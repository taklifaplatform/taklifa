<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateInvitationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string',],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'message' => 'nullable|string',
            'role' => 'required|string|in:company_manager,company_driver',
        ];
    }
}
