<?php

namespace Modules\Geography\Entities\Traits;

use Modules\Geography\Entities\LiveLocation;
use Modules\Geography\Entities\Location;

trait HasLocation
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function location()
    {
        return $this->morphOne(Location::class, 'locationable');
    }

    public function locations()
    {
        return $this->morphMany(Location::class, 'locationable');
    }

    public function liveLocations()
    {
        return $this->hasMany(LiveLocation::class);
    }

    public function latestLocation()
    {
        return $this->hasOne(LiveLocation::class)->latest();
    }
}
