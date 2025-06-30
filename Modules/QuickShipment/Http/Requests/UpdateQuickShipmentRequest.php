<?php

namespace Modules\QuickShipment\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateQuickShipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [          
            'driver_id' => ['uuid', 'exists:users,id'],

            'date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],

            ...TemporaryUpload::validationRules('medias.*'),
        ];
    }
}
