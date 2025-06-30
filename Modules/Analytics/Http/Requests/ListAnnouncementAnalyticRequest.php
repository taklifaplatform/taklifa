<?php

namespace Modules\Analytics\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class ListAnnouncementAnalyticRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'search' => ['string', 'nullable'],
            'action_type' => ['string', 'nullable', 'in:view,call_press'],
        ];
    }

}
