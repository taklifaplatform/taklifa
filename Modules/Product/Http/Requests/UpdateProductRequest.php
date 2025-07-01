<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
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
            'company_id' => ['required', 'string', 'exists:companies,id'],
            'category_id' => ['nullable', 'string', 'exists:product_categories,id'],
            'variants' => ['nullable', 'array'],
            'variants.*.price' => ['required_with:variants', 'numeric', 'min:0'],
            'variants.*.price_currency' => ['required_with:variants', 'string', 'max:3'],
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