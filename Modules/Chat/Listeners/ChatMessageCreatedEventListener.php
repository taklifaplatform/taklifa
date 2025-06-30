<?php

namespace Modules\Chat\Listeners;

use Modules\Chat\Entities\ChatMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Chat\Events\ChatMessageCreatedEvent;
use Modules\Chat\Notifications\ChatMessageNotification;

class ChatMessageCreatedEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ChatMessageCreatedEvent $event)
    {
        $message = ChatMessage::find($event->messageId);

        /**
         * Filter:
         * 1. Get all members of the channel
         *  Except, the user who sent the message, and member who have muted the channel
         *   - This is to prevent the user from receiving a notification for their own message
         */
        $message
            ->channel
            ->members()
            ->where('user_id', '!=', $message->user_id)
            ->where('notifications_muted', false)
            ->where('banned', false)
            ->where('shadow_banned', false)
            ->whereHas('user', function ($query) {
                $query->whereHas('notificationDrivers', function ($query) {
                    $query->where('driver', 'expo');
                });
            })
            ->get()
            ->each(function ($member) use ($message) {
                $member->user->notify(new ChatMessageNotification($message));
            });
    }
}
