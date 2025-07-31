<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'string', 'exists:product_categories,id'],
            'variant' => ['array'],
            'variant.price' => ['numeric'],
            'variant.price_currency' => ['string', 'max:3'],
            // 'variant.type' => ['string', 'in:count,weight,size'],
            'variant.type_unit' => ['string'],
            // 'variant.type_value' => ['numeric'],
            'variant.stock' => ['numeric'],

            'is_available' => ['boolean'],

            ...TemporaryUpload::validationRules('images.*'),

        ];
    }

}