<?php

namespace Modules\Services\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'price' => ['nullable'],

            'category_id' => ['nullable', 'exists:Service_categories,id'],
            'sub_category_id' => ['nullable', 'exists:Service_categories,id'],

            'metadata' => ['nullable', 'array'],

            'city' => ['nullable', 'string', 'max:255'],

            ...TemporaryUpload::validationRules('images.*'),
        ];
    }
}
