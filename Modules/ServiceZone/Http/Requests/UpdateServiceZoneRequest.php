<?php

namespace Modules\ServiceZone\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateServiceZoneRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],

            'areas' => 'array',
            'areas.*.name' => ['required', 'string'],
        ];
    }
}
