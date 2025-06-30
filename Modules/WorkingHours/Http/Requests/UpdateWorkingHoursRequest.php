<?php

namespace Modules\WorkingHours\Http\Requests;

use Modules\Core\Http\Requests\FormRequest;

class UpdateWorkingHoursRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'monday' => 'required|boolean',
            'monday_start' => 'required_if:monday,true',
            'monday_end' => 'required_if:monday,true',

            'tuesday' => 'required|boolean',
            'tuesday_start' => 'required_if:tuesday,true',
            'tuesday_end' => 'required_if:tuesday,true',

            'wednesday' => 'required|boolean',
            'wednesday_start' => 'required_if:wednesday,true',
            'wednesday_end' => 'required_if:wednesday,true',

            'thursday' => 'required|boolean',
            'thursday_start' => 'required_if:thursday,true',
            'thursday_end' => 'required_if:thursday,true',

            'friday' => 'required|boolean',
            'friday_start' => 'required_if:friday,true',
            'friday_end' => 'required_if:friday,true',

            'saturday' => 'required|boolean',
            'saturday_start' => 'required_if:saturday,true',
            'saturday_end' => 'required_if:saturday,true',

            'sunday' => 'required|boolean',
            'sunday_start' => 'required_if:sunday,true',
            'sunday_end' => 'required_if:sunday,true',
        ];
    }
}
