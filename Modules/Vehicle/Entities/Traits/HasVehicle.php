<?php

namespace Modules\Vehicle\Entities\Traits;

use Modules\Vehicle\Entities\Vehicle;

trait HasVehicle
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function vehicle()
    {
        return $this->morphOne(Vehicle::class, 'ownable');
    }

    public function vehicles()
    {
        return $this->morphMany(Vehicle::class, 'ownable');
    }
}
