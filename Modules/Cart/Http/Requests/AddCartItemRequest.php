<?php

namespace Modules\Cart\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;

class AddCartItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'string', 'exists:products,id'],
            'variant_id' => [
                'required', 'string',
                Rule::exists('product_variants', 'id')
                    ->where(fn ($q) => $q->where('product_id', $this->product_id))
            ],
            'quantity' => ['required', 'integer'],
        ];
    }
}