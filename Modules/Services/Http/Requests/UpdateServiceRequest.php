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

            'price.value' => ['nullable', 'integer'],
            'price.currency_id' => ['exists:currencies,id'],

            ...TemporaryUpload::validationRules('cover'),
            ...TemporaryUpload::validationRules('images.*'),
        ];
    }
}
