<?php

namespace Modules\Support\Entities\Traits;

use Modules\Support\Entities\Report;

trait HasReport
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
