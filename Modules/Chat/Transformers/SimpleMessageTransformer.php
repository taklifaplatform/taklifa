<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class SimpleMessageTransformer extends JsonTransformer
{
    public static $wrap = 'message';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user_id.'-'.$this->id,
            'cid' => 'messaging:first', // TODO: make this dynamic

            'parent_id' => $this->parent_id ? $this->parent->user_id.'-'.$this->parent_id : null,

            'type' => $this->type,

            'reply_count' => $this->replies_count,

            'text' => $this->text,
            'html' => "<p>{$this->text}</p>",

            // 'thread_participants' => ChatUserTransformer::collection($this->threadParticipants),

            // 'attachments' => AttachmentTransformer::collection($this->getMedia('attachments')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('SimpleMessageTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('propName')->required(),
            );
    }
}
