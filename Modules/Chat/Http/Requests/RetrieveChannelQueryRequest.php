<?php

namespace Modules\Chat\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class RetrieveChannelQueryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /**
         * "data":
[
],
"state":
true,
"messages":
{
"id_lt":
"9b63f22c-1a6c-4aa9-a429-325960ce893f",
"limit":
20
},
"user_id":
"8104206e-8ca0-4189-8b0f-df9668a26492",
         */
        return [
            'data' => 'array',
            'state' => 'boolean',
            'messages' => 'array',
            'messages.id_lt' => 'string',
            'messages.limit' => 'integer',
            'user_id' => 'string',
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
