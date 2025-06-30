<?php

namespace Modules\Chat\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class SendChannelEventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event' => 'array',
            'event.type' => [
                'required',
                'string',
                'in:typing.start,typing.stop',
            ],
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
