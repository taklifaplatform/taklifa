<?php

namespace Modules\Announcements\Http\Requests;

use Modules\Core\Http\Requests\QueryRequest;
use Modules\Core\Support\PaginatedQueryRequest;

class ListAnnouncementRequest extends QueryRequest
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
            'category_id' => ['exists:announcement_categories,id', 'nullable'],
            'sub_category_id' => ['exists:announcement_categories,id', 'nullable'],

            'sort_by' => ['string', 'in:created_at,price', 'nullable'],
            'sort_direction' => ['string', 'in:asc,desc'],

            'years' => ['string', 'nullable'],
        ];
    }
}
