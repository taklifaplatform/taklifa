<?php

namespace Modules\Support\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class ListReportQueryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'string'],
        ];
    }
}
