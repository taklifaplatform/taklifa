<?php

namespace Modules\UserVerification\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;
use Modules\Media\Entities\TemporaryUpload;

class DriverVerificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'driving_license_number' => ['required', 'string', 'max:255'],

            ...TemporaryUpload::validationRules('driving_license_card'),
            ...TemporaryUpload::validationRules('assurance_card'),
        ];
    }
}
