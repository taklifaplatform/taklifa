<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class MembershipTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'banned' => $this->banned,
            'channel_role' => $this->channel_role,
            'created_at' => $this->created_at,
            'notifications_muted' => $this->notifications_muted,
            'shadow_banned' => $this->shadow_banned,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'user' => ChatUserTransformer::make($this->user),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('MembershipTransformer')
            ->properties(
                Schema::boolean('banned'),
                Schema::string('channel_role'),
                Schema::string('created_at'),
                Schema::boolean('notifications_muted'),
                Schema::boolean('shadow_banned'),
                Schema::string('status'),
                Schema::string('updated_at'),
                // Schema::object('user', ChatUserTransformer::schema())
            );
    }
}
