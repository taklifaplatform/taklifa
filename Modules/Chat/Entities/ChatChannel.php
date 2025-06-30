<?php

namespace Modules\Chat\Entities;

use Modules\Core\Entities\BaseModel;

class ChatChannel extends BaseModel
{
    protected $fillable = [
        'name',
        'type',
        'is_public',
        'frozen',
        'disabled',
        'hidden',
        'creator_id',
    ];

    public function members()
    {
        return $this->hasMany(ChatChannelMember::class, 'channel_id');
    }

    //membership
    public function membership()
    {
        return $this->hasOne(ChatChannelMember::class, 'channel_id')
            ->where('user_id', auth()->id());
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'channel_id');
    }

    public function invitations()
    {
        return $this->hasMany(ChatChannelInvitation::class, 'channel_id');
    }
}
