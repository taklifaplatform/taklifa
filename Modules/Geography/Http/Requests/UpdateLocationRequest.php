<?php

namespace Modules\Geography\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        //
        return [
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'state_id' => ['nullable', 'integer', 'exists:states,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'address' => ['nullable', 'string'],
            'address_complement' => ['nullable', 'string'],

            'building_name' => ['nullable', 'string'],
            'floor_number' => ['nullable', 'string'],
            'house_number' => ['nullable', 'string'],

            'notes' => ['nullable', 'string'],

            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'postcode' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string'],
            'is_primary' => ['nullable', 'boolean'],
        ];
    }
}
