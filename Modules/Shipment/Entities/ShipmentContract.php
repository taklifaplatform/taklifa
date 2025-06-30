<?php

namespace Modules\Shipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Company\Entities\Company;
use Modules\Geography\Entities\Price;
use Modules\Chat\Entities\ChatChannel;

class ShipmentContract extends BaseModel
{
    const STATUS_STARTED = 'started';
    const STATUS_DELIVERING = 'delivering';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'shipment_id',
        'proposal_id',
        'driver_id',
        'company_id',
        'total_cost_id',
        'fee_id',
        'channel_id',
        'status',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function proposal()
    {
        return $this->belongsTo(ShipmentProposal::class, 'proposal_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function totalCost()
    {
        return $this->hasOne(Price::class, 'id', 'total_cost_id');
    }

    public function cancelRequests()
    {
        return $this->hasMany(ShipmentContractCancelRequest::class, 'contract_id');
    }

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }
}
