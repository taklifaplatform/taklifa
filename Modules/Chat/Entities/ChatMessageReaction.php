<?php

namespace Modules\Chat\Entities;

use App\Models\User;
use Modules\Core\Entities\BaseModel;

class ChatMessageReaction extends BaseModel
{
    protected $fillable = [
        'user_id',
        'message_id',
        'type',
        'score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function message()
    {
        return $this->belongsTo(ChatMessage::class);
    }
}
