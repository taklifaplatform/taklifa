<?php

namespace Modules\Chat\Notifications;

use Illuminate\Bus\Queueable;
use Modules\Chat\Entities\ChatChannel;
use Modules\Chat\Entities\ChatMessage;
use Illuminate\Notifications\Notification;
use Modules\Notification\Drivers\Expo\ExpoChannel;
use Modules\Notification\Drivers\Expo\ExpoMessage;

class ChatMessageNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public ChatMessage $message
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $sender = $this->message->user;

        return [
            'filter' => 'chat',
            'from_user_id' => $sender->id,
            'type' => 'ChatMessageNotification',
            'title' => $sender->name ?? $sender->username,
            'description' => $this->message->text,
            'model_type' => ChatChannel::class,
            'model_id' => $this->message->channel_id,
            'unread_notifications' => $notifiable->unreadNotifications->count() + 1,
        ];
    }

    public function toExpo($notifiable)
    {
        $sender = $this->message->user;
        return ExpoMessage::create()
            ->title($sender->name ?? $sender->username)
            ->body($this->message->text);
    }
}
