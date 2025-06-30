<?php

namespace Modules\Shipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class ShipmentContractCancelRequest extends BaseModel
{
    protected $fillable = [
        'contract_id',
        'reason_id',
        'message',
    ];

    public function contract()
    {
        return $this->belongsTo(ShipmentContract::class, 'contract_id');
    }

    public function reason()
    {
        return $this->belongsTo(ShipmentContractCancelReason::class, 'reason_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
