<?php

namespace Modules\Analytics\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class ListUserAnalyticRequest extends FormRequest
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
            'action_type' => ['string', 'nullable', 'in:profile_view,map_view,call_press'],
        ];
    }

}
