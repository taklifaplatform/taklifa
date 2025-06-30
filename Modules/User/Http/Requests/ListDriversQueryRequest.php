<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListDriversQueryRequest extends QueryRequest
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
            'search' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'latitude_delta' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'longitude_delta' => ['nullable', 'numeric'],
            'vehicle_model' => ['string'],
            'urgency_service_provider' => ['numeric', 'nullable'],
        ];
    }
}
