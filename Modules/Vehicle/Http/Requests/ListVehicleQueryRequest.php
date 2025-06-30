<?php

namespace Modules\Vehicle\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListVehicleQueryRequest extends QueryRequest
{
    use PaginatedQueryRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string'],
        ];
    }
}
