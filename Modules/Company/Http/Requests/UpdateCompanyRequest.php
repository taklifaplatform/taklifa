<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'about' => 'nullable|string',

            'legal_documents' => 'array',
            ...TemporaryUpload::validationRules('legal_documents.*'),

            ...TemporaryUpload::validationRules('logo'),
            'location_id' => ['nullable', 'exists:locations,id'],
        ];
    }
}
