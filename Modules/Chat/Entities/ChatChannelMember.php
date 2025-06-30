<?php

namespace Modules\Chat\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class ChatChannelMember extends BaseModel
{
    protected $fillable = [
        'channel_id',
        'user_id',
        'role',
        'channel_role',
        'status',
        'notifications_muted',
        'shadow_banned',
        'banned',
    ];

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
