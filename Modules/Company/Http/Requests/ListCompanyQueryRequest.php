<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListCompanyQueryRequest extends QueryRequest
{
    use PaginatedQueryRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'has_saudi_products' => ['nullable', 'boolean'],
            'has_international_products' => ['nullable', 'boolean'],
        ];
    }
}
