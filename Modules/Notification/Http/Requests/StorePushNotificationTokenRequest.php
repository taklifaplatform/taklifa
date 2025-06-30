<?php

namespace Modules\Notification\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class StorePushNotificationTokenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => ['required', 'string'],
        ];
    }
}
