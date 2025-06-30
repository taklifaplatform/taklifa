<?php

namespace Modules\Analytics\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class UserAnalytic extends BaseModel
{
    protected $fillable = [
        'user_id',
        'viewer_id',
        'action_type',
        'count',
        'ip_address',
        'call_type',
    ];

    public const ACTION_TYPES = [
        'profile_view',
        'map_view',
        'call_press'
    ];

    public const CALL_TYPES = [
        'phone',
        'whatsapp',
    ];

    protected $casts = [
        'count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }
}
