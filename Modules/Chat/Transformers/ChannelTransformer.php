<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ChannelTransformer extends JsonTransformer
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'channel' => [
                ...parent::toArray($request),
                // TODO: get current auth member capabilities
                'own_capabilities' => [
                    'ban-channel-members',
                    'connect-events',
                    'create-call',
                    // "delete-any-message",
                    'delete-channel',
                    'delete-own-message',
                    'flag-message',
                    'freeze-channel',
                    'join-call',
                    'join-channel',
                    'leave-channel',
                    'mute-channel',
                    // "pin-message",
                    'quote-message',
                    'read-events',
                    'search-messages',
                    'send-custom-events',
                    'send-links',
                    'send-message',
                    'send-reaction',
                    'send-reply',
                    'send-typing-events',
                    'set-channel-cooldown',
                    'typing-events',
                    'update-any-message',
                    'update-channel',
                    'update-channel-members',
                    'update-own-message',
                    'upload-file',
                ],
            ],
            'members' => MemberTransformer::collection($this->members),
            'membership' => MembershipTransformer::make($this->membership),
            'messages' => MessageTransformer::collection($this->messages),

            'watcher_count' => $this->members->count(),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ChannelTransformer')
            ->properties(
                Schema::object('channel')->properties(
                    Schema::string('id')->required(),
                    Schema::array('own_capabilities')->items(Schema::string()),
                ),

                Schema::integer('watcher_count'),
            );
    }
}
