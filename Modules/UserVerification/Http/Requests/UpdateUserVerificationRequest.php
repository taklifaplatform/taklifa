<?php

namespace Modules\UserVerification\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class UpdateUserVerificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // 'name' => ['required', 'string', 'max:255'],
            // 'birth_date' => ['required', 'date'],
            'nationality_id' => ['required', 'exists:countries,id'],
            'location_id' => ['required', 'exists:locations,id'],

            ...TemporaryUpload::validationRules('identity_card'),
        ];
    }
}
