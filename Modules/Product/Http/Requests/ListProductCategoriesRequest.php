<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Support\PaginatedQueryRequest;
use Modules\Core\Http\Requests\QueryRequest;

class ListProductCategoriesRequest extends QueryRequest
{
    use PaginatedQueryRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['string', 'max:255', 'nullable'],
            'category_id' => ['string', 'max:255', 'nullable'],
            'parent_id' => ['string', 'max:255', 'nullable'],
            'per_page' => ['integer', 'min:1', 'max:100', 'nullable'],
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