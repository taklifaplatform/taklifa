<?php

namespace Modules\Support\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reason_id' => ['nullable', 'integer', 'exists:report_reasons,id'],
            'message' => ['required', 'string'],
            'reportable_type' => ['required', 'string'],
            'reportable_id' => ['required', 'integer'],
        ];
    }
}
