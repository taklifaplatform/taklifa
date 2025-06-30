<?php

namespace Modules\Shipment\Entities;

use Modules\Core\Entities\BaseModel;

class ShipmentContractCancelReason extends BaseModel
{
    protected $fillable = [
        'title',
        'for_customer',
    ];

    public function cancelRequests()
    {
        return $this->hasMany(ShipmentContractCancelRequest::class, 'reason_id');
    }
}
