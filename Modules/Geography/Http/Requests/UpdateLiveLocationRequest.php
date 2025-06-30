<?php

namespace Modules\Geography\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateLiveLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        //
        return [
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ];
    }
}
