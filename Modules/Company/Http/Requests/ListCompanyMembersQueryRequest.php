<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListCompanyMembersQueryRequest extends QueryRequest
{
    use PaginatedQueryRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:online,busy,offline'],
            'role' => ['nullable', 'string', 'in:company_manager'],
        ];
    }
}
