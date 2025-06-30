<?php

namespace Modules\Shipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Company\Entities\Company;
use Modules\Geography\Entities\Price;
use Modules\Chat\Entities\ChatChannel;
use Modules\Geography\Entities\Traits\HasPrice;

class ShipmentProposal extends BaseModel
{
    use HasPrice;

    const STATUS_PENDING = 'pending';

    const STATUS_ACCEPTED = 'accepted';

    const STATUS_DECLINED = 'declined';

    const STATUS_HIRED = 'hired';

    protected $fillable = [
        'shipment_id',
        'driver_id',
        'company_id',
        'invitation_id',
        'channel_id',
        'status',
        'message',
        'ship_time',
        'ship_date',

        'cost_id',
        'fee_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function invitation()
    {
        return $this->belongsTo(ShipmentInvitation::class, 'invitation_id');
    }

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }

    public function cost()
    {
        return $this->hasOne(Price::class, 'id', 'cost_id');
    }

    public function fee()
    {
        return $this->hasOne(Price::class, 'id', 'fee_id');
    }
}
