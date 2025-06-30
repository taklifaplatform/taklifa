<?php

namespace Modules\Vehicle\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'internal_id' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'plate_number' => ['nullable', 'string'],
            'vin_number' => ['nullable', 'string'],
            'year' => ['nullable', 'integer'],

            ...TemporaryUpload::validationRules('image'),
            ...TemporaryUpload::validationRules('images.*'),

            'model_id' => ['required', 'uuid', 'exists:vehicle_models,id'],

            // vehicle information validation
            'information.body_type' => ['nullable', 'string'],
            'information.steering_wheel' => ['nullable', 'string'],
            'information.doors_count' => ['nullable', 'integer', 'min:1', 'max:10'],
            'information.seats_count' => ['nullable', 'integer', 'min:1', 'max:20'],
            'information.top_speed' => ['nullable', 'integer', 'min:1', 'max:300'],

            //vehicle fuel information validation
            'fuel_information.fuel_type' => ['nullable', 'string'],
            'fuel_information.fuel_capacity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'fuel_information.liter_per_km_in_city' => ['nullable', 'integer', 'min:1', 'max:400'],
            'fuel_information.liter_per_km_in_highway' => ['nullable', 'integer', 'min:1', 'max:400'],
            'fuel_information.liter_per_km_mixed' => ['nullable', 'integer', 'min:1', 'max:400'],

            // //vehicle capacity dimensions validation
            'capacity_dimensions.width' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'capacity_dimensions.height' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'capacity_dimensions.length' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'capacity_dimensions.unit' => ['nullable', 'string'],

            // //vehicle capacity weight validation
            'capacity_weight.value' => ['nullable', 'integer', 'min:1', 'max:10000'],
            'capacity_weight.unit' => ['nullable', 'string'],
        ];
    }
}
