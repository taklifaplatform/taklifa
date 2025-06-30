<?php

namespace Modules\Chat\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Chat\Entities\ChatMessage;
use Modules\Chat\Transformers\MessageTransformer;
use Modules\Chat\Transformers\ChatUserTransformer;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    public string $type = 'message.new';

    public string $channel_id;

    public string $channel_type;

    public string $cid;

    public int $watcher_count = 2;

    public MessageTransformer $message;

    public ChatUserTransformer $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public string $messageId,
    ) {
        $message = ChatMessage::with(ChatMessage::EAGER_LOADS_WITH)->withCount(ChatMessage::EAGER_LOADS_WITH_COUNT)->find($messageId);

        $this->message = new MessageTransformer($message);
        $this->user = new ChatUserTransformer($message->user);
        $this->channel_id = $message->channel_id;
        $this->channel_type = 'messaging';
        $this->cid = 'messaging:'.$message->channel_id;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'message';
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [
            'chat',
        ];
    }
}
