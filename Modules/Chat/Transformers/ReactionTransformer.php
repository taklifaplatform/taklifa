<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ReactionTransformer extends JsonTransformer
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
            // 'id' => $this->id,
            'type' => $this->type,
            'score' => $this->score,
            'message_id' => $this->message->user_id.'-'.$this->message_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => ChatUserTransformer::make($this->user),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ReactionTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('type')->required(),
                Schema::integer('score')->required(),
                Schema::integer('message_id')->required(),
                Schema::integer('user_id')->required(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
                Schema::ref('#/components/schemas/ChatUserTransformer', 'user'),

            );
    }
}
