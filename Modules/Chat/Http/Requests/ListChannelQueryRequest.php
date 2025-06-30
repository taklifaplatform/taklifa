<?php

namespace Modules\Chat\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class ListChannelQueryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter_conditions' => 'array',
            'filter_conditions.type' => 'string',
            'filter_conditions.members' => 'array',
            'sort' => 'array',
            'sort.*.field' => 'string',
            'sort.*.direction' => 'in:-1,1',
            'state' => 'boolean',
            'watch' => 'boolean',
            'presence' => 'boolean',
            'limit' => 'integer',
            'offset' => 'integer',
            'user_id' => 'string',
            'api_key' => 'string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
