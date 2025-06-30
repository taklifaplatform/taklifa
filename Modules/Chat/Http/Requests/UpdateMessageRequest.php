<?php

namespace Modules\Chat\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /**
         * {
    "message": {
        "attachments": [],
        "id": "8104206e-8ca0-4189-8b0f-df9668a26492-4f05924c-149e-47fa-0fce-e2fbbad385e0",
        "mentioned_users": [],
        "text": "Fe"
    },
    "user_id": "8104206e-8ca0-4189-8b0f-df9668a26492",
    "api_key": "are"
}
         */
        return [
            'message' => 'array|required',
            'message.attachments' => 'array',
            'message.id' => 'string',
            'message.mentioned_users' => 'array',
            'message.text' => ['string', 'nullable'],
            'message.html' => ['nullable', 'string'],
            'message.quoted_message_id' => ['nullable', 'string'],
            'message.parent_id' => ['nullable', 'string'],
            'message.show_in_channel' => 'boolean',
            // 'user_id' => 'string',
            // 'api_key' => 'string'
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
