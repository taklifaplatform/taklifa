<?php

namespace Modules\WorkingHours\Entities\Traits;

use Modules\WorkingHours\Entities\WorkingHour;

trait HasWorkingHour
{
    public function workingHour()
    {
        return $this->morphOne(WorkingHour::class, 'working_hourable');
    }
}
