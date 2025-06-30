<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateUserLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'location_id' => 'required|exists:locations,id',
        ];
    }
}
