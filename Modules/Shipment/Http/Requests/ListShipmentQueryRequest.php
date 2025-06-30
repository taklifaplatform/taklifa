<?php

namespace Modules\Shipment\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListShipmentQueryRequest extends QueryRequest
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
            'status' => [
                'nullable',
                'string',
                // 'in:draft,searching,delivering,delivered,cancelled,pending,expired,rejected,completed,failed,returned,lost,damaged,stolen,other',
            ],
            'items_type' => ['nullable', 'string', 'in:document,box,multiple_boxes,other'],
            'role' => [
                'nullable', 'string',
                'in:customer,company_owner,company_manager,company_driver,solo_driver',
            ],
        ];
    }
}
