<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $this->user()?->id],
            'name' => ['required', 'string', 'max:255'],
            'about' => 'nullable|string',
            ...TemporaryUpload::validationRules('avatar'),
        ];
    }
}
