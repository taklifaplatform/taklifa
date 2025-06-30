<?php

namespace Modules\Shipment\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class AcceptInvitationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ship_date' => ['nullable', 'date'],
            'ship_time' => ['nullable', 'string'],

            'cost.value' => ['nullable', 'integer'],
            'cost.currency_id' => ['exists:currencies,id'],
            'fee.value' => ['nullable', 'integer'],
            'fee.currency_id' => ['exists:currencies,id'],

            'message' => ['nullable', 'string'],
        ];
    }
}
