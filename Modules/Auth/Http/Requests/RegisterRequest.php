<?php

namespace Modules\Auth\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Modules\Core\Http\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'phone_number' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'phone_number')->whereNotNull('phone_number_verified_at'),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required',

            'is_customer' => 'boolean',
            'is_company_owner' => 'boolean',
            'is_service_provider' => 'boolean',
        ];
    }
}
