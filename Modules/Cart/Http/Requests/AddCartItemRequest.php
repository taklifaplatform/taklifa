<?php

namespace Modules\Cart\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\FormRequest;

class AddCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'string', 'exists:products,id'],
            'variant_id' => [
                'required', 
                'string', 
                'exists:product_variants,id',
                Rule::exists('product_variants', 'id')->where(function ($query) {
                    return $query->where('product_id', $this->product_id);
                })
            ],
            'quantity' => ['required', 'integer'],
        ];
    }
} 