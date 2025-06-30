<?php

namespace Modules\Shipment\Entities\Traits;

use Modules\Shipment\Entities\Shipment;

trait HasShipment
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'user_id');
    }
}
