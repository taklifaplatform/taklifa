<?php

namespace Modules\Shipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Modules\Geography\Entities\Price;
use Modules\Geography\Entities\Location;
use Modules\Geography\Entities\Traits\HasPrice;
use Modules\Geography\Entities\Traits\HasLocation;
use Modules\Shipment\ShipmentHelper\ShipmentHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipment\Http\Requests\ListShipmentQueryRequest;

class Shipment extends BaseModel
{
    use HasFactory, HasLocation, HasPrice;

    /**
     * Shipment Status:
     * - draft: (just created, only visible to the person who created it)
     * - searching: (the customer is looking for someone to deliver the shipment)
     * - assigned: (the customer has assigned the shipment to a delivery person)
     * - delivering: (the delivery person is delivering the shipment)
     * - delivered: (the shipment has been delivered)
     * - cancelled: (the shipment has been cancelled)
     * - pending: (the shipment is waiting for the delivery person to accept it)
     * - expired: (the shipment has expired)
     * - rejected: (the delivery person has rejected the shipment)
     * - completed: (the shipment has been completed)
     * - failed: (the shipment has failed)
     * - returned: (the shipment has been returned)
     * - lost: (the shipment has been lost)
     * - damaged: (the shipment has been damaged)
     * - stolen: (the shipment has been stolen)
     * - other: (the shipment has been affected by other issues)
     */
    const CUSTOMER_STATUS_GROUP = [
        self::STATUS_DRAFT,
        self::STATUS_SEARCHING,
        self::STATUS_ASSIGNED,
        self::STATUS_DELIVERING,
        self::STATUS_DELIVERED,
        self::STATUS_CANCELLED,
    ];

    const COMPANY_STATUS_GROUP = [
        self::STATUS_ASSIGNED,
        self::STATUS_DELIVERING,
        self::STATUS_DELIVERED,
        self::STATUS_CANCELLED,
    ];

    const SOLO_DRIVER_STATUS_GROUP = [
        self::STATUS_ASSIGNED,
        self::STATUS_DELIVERING,
        self::STATUS_DELIVERED,
        self::STATUS_CANCELLED,
    ];

    const STATUS_DRAFT = 'draft'; // initial status

    const STATUS_SEARCHING = 'searching'; // when the customer is looking for someone to deliver the shipment

    const STATUS_ASSIGNED = 'assigned'; // when the customer has assigned the shipment to a delivery person

    const STATUS_DELIVERING = 'delivering';

    const STATUS_DELIVERED = 'delivered';

    const STATUS_CANCELLED = 'cancelled';

    const STATUS_PENDING = 'pending';

    const STATUS_EXPIRED = 'expired';

    const STATUS_REJECTED = 'rejected'; // TODO: move the shipment contract

    const STATUS_COMPLETED = 'completed';

    /**
     * Shipment Items Type:
     * - document
     * - box
     * - multiple_boxes
     * - other
     */
    const ITEMS_TYPE_DOCUMENT = 'document';

    const ITEMS_TYPE_BOX = 'box';

    const ITEMS_TYPE_MULTIPLE_BOXES = 'multiple_boxes';

    const ITEMS_TYPE_OTHER = 'other';

    protected $fillable = [
        'user_id',
        'from_location_id',
        'to_location_id',
        'pick_date',
        'pick_time',
        'deliver_date',
        'deliver_time',
        
        'min_budget_id',
        'max_budget_id',
        'items_type',
        'status',

        'recipient_name',
        'recipient_phone',
        'should_notify_customer',

        'selected_driver_id',
        'selected_company_id',
    ];

    protected $casts = [
        'pick_date' => 'date',
        'deliver_date' => 'date',
    ];


    protected $dates = [
        'pick_date',
        'deliver_date',
    ];

    public function scopeFilter($query, ListShipmentQueryRequest $request)
    {
        $query->when($request->search, function ($query, $search) {
            $query->whereHas('items', function ($query) use ($search) {
                $query->where('notes', 'like', "%$search%");
            });
        });

        $query->when($request->status, function ($query, $status) {
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        });

        $query->when($request->items_type, function ($query, $itemsType) {
            $query->where('items_type', $itemsType);
        });

        $query->when($request->role, function ($query, $role) {
            if ($role === 'customer') {
                $query
                    ->where('user_id', auth()->id())
                    ->orWhere('recipient_id', auth()->id());

                $query->whereIn('status', self::CUSTOMER_STATUS_GROUP);
            }

            if (in_array($role, ['company_owner', 'company_manager', 'company_driver'])) {
                $companies = auth()->user()->companies()->pluck('company_id')->unique()->toArray();
                $query
                    ->whereHas('invitations', function ($query) use ($companies) {
                        $query->whereIn('company_id', $companies);
                    })
                    ->orWhereHas('proposals', function ($query) use ($companies) {
                        $query->whereIn('company_id', $companies);
                    })
                    ->orWhereHas('contracts', function ($query) use ($companies) {
                        $query->whereIn('company_id', $companies);
                    });
                $query->whereIn('status', self::COMPANY_STATUS_GROUP);
            }

            if ($role === 'solo_driver') {
                $query
                    ->whereHas('invitations', function ($query) {
                        $query->where('driver_id', auth()->id())
                            ->where('company_id', null);
                    })
                    ->orWhereHas('proposals', function ($query) {
                        $query->where('driver_id', auth()->id())
                            ->where('company_id', null);
                    })
                    ->orWhereHas('contracts', function ($query) {
                        $query->where('driver_id', auth()->id())
                            ->where('company_id', null);
                    });
                $query->whereIn('status', self::SOLO_DRIVER_STATUS_GROUP);
            }
        });

        return $query;
    }

    public function helper(): ShipmentHelper
    {
        return new ShipmentHelper($this);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }

    public function minBudget()
    {
        return $this->hasOne(Price::class, 'id', 'min_budget_id');
    }

    public function maxBudget()
    {
        return $this->hasOne(Price::class, 'id', 'max_budget_id');
    }

    public function items()
    {
        return $this->hasMany(ShipmentItem::class, 'shipment_id');
    }

    public function invitations()
    {
        return $this->hasMany(ShipmentInvitation::class, 'shipment_id');
    }

    public function pendingInvitations()
    {
        return $this->invitations()->where('status', ShipmentInvitation::STATUS_PENDING);
    }

    public function proposals()
    {
        return $this->hasMany(ShipmentProposal::class, 'shipment_id');
    }

    public function acceptedProposals()
    {
        return $this->proposals()->where('status', ShipmentProposal::STATUS_ACCEPTED);
    }

    public function contracts()
    {
        return $this->hasMany(ShipmentContract::class, 'shipment_id');
    }

    public function activeContract()
    {
        return $this->hasOne(ShipmentContract::class, 'id', 'active_contract_id');
    }

    public function getFormattedMinBudgetAttribute()
    {
        // Assuming 'value' is stored as a decimal or float
        return number_format($this->minBudget->value, 2, '.', ',');
    }

    public function getUrlFor($role)
    {
        if ($role === 'recipient') {
            return "https://sawaeed.app/shipments/{$this->code}?role={$role}";
        }

        return "https://sawaeed.app/app/shipments/{$this->id}";
    }
}
