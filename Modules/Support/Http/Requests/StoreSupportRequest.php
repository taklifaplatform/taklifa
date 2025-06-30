<?php

namespace Modules\Support\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class StoreSupportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'support_category_id' => ['nullable', 'integer', 'exists:support_categories,id'],
            'email' => ['required', 'string'],
            'phone_number' => ['nullable', 'string'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
        ];
    }
}
