<?php

namespace Modules\Company\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class AcceptInviteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'invitation_code' => 'required|string',
        ];
    }
}
