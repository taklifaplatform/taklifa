<?php

namespace Modules\Chat\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class ChannelEvent extends BaseModel
{
    protected $fillable = [
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(ChatChannel::class);
    }
}
