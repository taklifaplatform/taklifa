<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class MemberTransformer extends JsonTransformer
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
            'role' => $this->role,
            'channel_role' => $this->channel_role,
            'status' => $this->status,
            'notifications_muted' => $this->notifications_muted,
            'shadow_banned' => $this->shadow_banned,

            'user_id' => $this->user_id,
            'user' => new ChatUserTransformer($this->user),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('MemberTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('propName')->required(),
            );
    }
}
