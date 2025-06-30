<?php

namespace Modules\Chat\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class ChatChannelInvitation extends BaseModel
{
    protected $fillable = [
        'channel_id',
        'user_id',
        'added_by_user_id',
    ];

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class, 'channel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }
}
