<?php

namespace Modules\Product\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

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