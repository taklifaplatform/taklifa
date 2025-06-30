<?php

namespace Modules\Analytics\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateUserAnalyticRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'action_type' => [
                'required',
                'string',
                'in:' . implode(',', \Modules\Analytics\Entities\UserAnalytic::ACTION_TYPES),
            ],
            'call_type' => [
                'string',
                'in:' . implode(',', \Modules\Analytics\Entities\UserAnalytic::CALL_TYPES),
            ],
        ];
    }
}
