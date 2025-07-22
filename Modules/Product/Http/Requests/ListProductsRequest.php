<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;
use Illuminate\Validation\Rule;

class ListProductsRequest extends QueryRequest
{
    use PaginatedQueryRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['string', 'max:255'],
            'company_id' => ['string', 'exists:companies,id', 'nullable'],
            'order_by' => ['string', 'nullable'],
            'order_direction' => ['string', 'nullable', Rule::in(['asc', 'desc'])],
            'min_price' => ['numeric', 'nullable'],
            'max_price' => ['numeric', 'nullable'],
            'include_unpublished' => ['boolean', 'nullable'],
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