<?php

namespace Modules\WorkingHours\Entities;

use Modules\Core\Entities\BaseModel;

class WorkingHour extends BaseModel
{
    protected $fillable = [
        'monday',
        'monday_start',
        'monday_end',

        'tuesday',
        'tuesday_start',
        'tuesday_end',

        'wednesday',
        'wednesday_start',
        'wednesday_end',

        'thursday',
        'thursday_start',
        'thursday_end',

        'friday',
        'friday_start',
        'friday_end',

        'saturday',
        'saturday_start',
        'saturday_end',

        'sunday',
        'sunday_start',
        'sunday_end',
    ];

    protected $casts = [
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'sunday' => 'boolean',
    ];

    public function workingHourable()
    {
        return $this->morphTo();
    }
}
