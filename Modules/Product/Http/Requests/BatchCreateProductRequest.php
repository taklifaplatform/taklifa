<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class BatchCreateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'images' => ['required', 'array', 'min:1'],
            ...TemporaryUpload::validationRules('images.*'),
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