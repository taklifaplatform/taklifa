<?php

namespace Modules\QuickShipment\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuickShipment extends BaseModel
{

    protected $fillable = [
        'notes',
        'price',
        'date',
        'user_id',
        'driver_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
