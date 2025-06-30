<?php

namespace Modules\Shipment\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Geography\Entities\Location;
use Modules\Media\Entities\TemporaryUpload;

class UpdateShipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_location_id' => ['nullable', 'exists:locations,id'],
            'to_location_id' => ['nullable', 'exists:locations,id'],


            'selected_driver_id' => ['nullable', 'uuid', 'exists:users,id'],
            'selected_company_id' => ['nullable', 'uuid', 'exists:companies,id'],

            'pick_date' => ['nullable', 'date'],
            'pick_time' => ['nullable', 'string'],

            'deliver_date' => ['nullable', 'date'],
            'deliver_time' => ['nullable', 'string'],

            'recipient_name' => ['nullable', 'string'],
            'recipient_phone' => ['nullable', 'string'],

            'items_type' => ['nullable', 'string'],

            'min_budget.value' => ['nullable', 'integer'],
            'min_budget.currency_id' => ['exists:currencies,id'],

            'max_budget.value' => ['nullable', 'integer'],
            'max_budget.currency_id' => ['exists:currencies,id'],

            'should_notify_customer' => ['nullable', 'boolean'],

            // items is an array of objects
            'items' => ['nullable', 'array'],
            'items.*.id' => ['nullable', 'string'],
            'items.*.notes' => ['nullable', 'string'],
            'items.*.dim_width' => ['nullable', 'integer'],
            'items.*.dim_height' => ['nullable', 'integer'],
            'items.*.dim_length' => ['nullable', 'integer'],
            'items.*.cap_unit' => ['nullable', 'string'],
            'items.*.cap_weight' => ['nullable', 'integer'],
            'items.*.content' => ['nullable', 'string'],
            ...TemporaryUpload::validationRules('items.*.medias.*'),

            // ShipmentInvitations is an array of objects
            'invitations.*.driver_id' => ['nullable', 'uuid', 'exists:users,id'],
            'invitations.*.company_id' => ['nullable', 'uuid', 'exists:companies,id'],
        ];
    }
}
