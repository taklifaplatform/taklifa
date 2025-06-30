<?php

namespace Modules\Services\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListServiceRequest extends QueryRequest
{
    use PaginatedQueryRequest;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => ['string', 'nullable'],
        ];
    }
}
