<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class MessageTransformer extends JsonTransformer
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
        $content = [
            'text' => $this->text,
            'html' => "<p>{$this->text}</p>",

            'reply_count' => $this->replies_count,

            'mentioned_users' => ChatUserTransformer::collection($this->mentionedUsers),

            'reaction_counts' => $this->reaction_counts,
            'reaction_scores' => $this->reaction_scores,
            'latest_reactions' => ReactionTransformer::collection($this->latestReactions),
            'own_reactions' => ReactionTransformer::collection($this->ownReactions),

            'quoted_message' => SimpleMessageTransformer::make($this->quotedMessage),

            'thread_participants' => ChatUserTransformer::collection($this->threadParticipants),

            'attachments' => AttachmentTransformer::collection($this->attachments),

        ];

        if ($this->type === 'deleted') {
            $content = [];
        }

        return [
            ...$content,
            'id' => $this->user_id.'-'.$this->id,
            'cid' => 'messaging:first', // TODO: make this dynamic

            'parent_id' => $this->parent_id ? $this->parent->user_id.'-'.$this->parent_id : null,

            'type' => $this->type,

            'user' => ChatUserTransformer::make($this->user),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('MessageTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('cid')->required(),
                Schema::string('parent_id')->nullable(),
                Schema::string('type')->required(),
                Schema::integer('reply_count')->required(),
                Schema::string('text')->required(),
                Schema::string('html')->required(),
                Schema::array('mentioned_users')->items(Schema::ref('#/components/schemas/ChatUserTransformer'))->required(),
                Schema::object('reaction_counts')->properties(
                    Schema::integer('like')->required(),
                    Schema::integer('love')->required(),
                    Schema::integer('haha')->required(),
                    Schema::integer('wow')->required(),
                    Schema::integer('sad')->required(),
                    Schema::integer('angry')->required(),
                )->required(),
                Schema::object('reaction_scores')->properties(
                    Schema::integer('like')->required(),
                    Schema::integer('love')->required(),
                    Schema::integer('haha')->required(),
                    Schema::integer('wow')->required(),
                    Schema::integer('sad')->required(),
                    Schema::integer('angry')->required(),
                )->required(),
                Schema::array('latest_reactions')->items(Schema::ref('#/components/schemas/ReactionTransformer'))->required(),
                Schema::array('own_reactions')->items(Schema::ref('#/components/schemas/ReactionTransformer'))->required(),
                Schema::ref('#/components/schemas/ChatUserTransformer', 'user')->required(),
                Schema::ref('#/components/schemas/SimpleMessageTransformer', 'quoted_message')->nullable(),
                Schema::array('thread_participants')->items(Schema::ref('#/components/schemas/ChatUserTransformer'))->required(),
                Schema::array('attachments')->items(Schema::ref('#/components/schemas/AttachmentTransformer'))->required(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),

            );
    }
}
