<?php

namespace Modules\ServiceZone\Entities\Traits;

use Modules\ServiceZone\Entities\ServiceZone;

trait HasServiceZone
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function serviceZones()
    {
        return $this->morphOne(ServiceZone::class, 'ownable');
    }
}
