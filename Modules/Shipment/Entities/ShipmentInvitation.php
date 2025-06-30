<?php

namespace Modules\Shipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Company\Entities\Company;
use Modules\Geography\Entities\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipmentInvitation extends BaseModel
{
    use HasFactory, HasPrice;

    const STATUS_PENDING = 'pending';

    const STATUS_ACCEPTED = 'accepted';

    const STATUS_DECLINED = 'declined';

    protected $fillable = [
        'shipment_id',
        'driver_id',
        'company_id',
        'status',
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

    // proposal
    public function proposal()
    {
        return $this->hasOne(ShipmentProposal::class, 'invitation_id');
    }
}
