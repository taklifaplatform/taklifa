<?php

namespace Modules\Chat\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateReactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reaction' => 'required|array',
            'reaction.type' => 'required|string',
            'enforce_unique' => 'nullable|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
