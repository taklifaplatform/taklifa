<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateCompanyBranchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'contact_number' => ['required', 'string', 'max:20'],
            'location_id' => ['nullable', 'exists:locations,id'],
        ];
    }
} 