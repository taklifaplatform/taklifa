<?php

namespace Modules\Rating\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateRatingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'entity_id' => 'required|string',
            'entity_type' => 'required|string|in:driver,company',

            'comment' => 'nullable|string',

            'rates.*.score' => 'required|integer|min:0|max:5',
            'rates.*.rating_type_id' => 'required|string|exists:rating_types,id',
        ];
    }
}
