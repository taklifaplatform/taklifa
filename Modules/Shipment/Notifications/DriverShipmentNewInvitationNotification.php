<?php

namespace Modules\Shipment\Notifications;

use Illuminate\Bus\Queueable;
use Modules\Shipment\Entities\Shipment;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Notification\Drivers\Expo\ExpoChannel;
use Modules\Notification\Drivers\Expo\ExpoMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class DriverShipmentNewInvitationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public Shipment $shipment
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
        return ['database', 'broadcast', ExpoChannel::class];
    }

    public function getSenderImage()
    {
        return $this->shipment->user->getFirstMedia('logo');
    }

    public function getSenderName()
    {
        return $this->shipment->user->name;
    }

    /**
     * @return string
     */
    public function getTitle($notifiable)
    {
        return $this->getSenderName();
    }

    /**
     * @return string
     */
    public function getDescription($notifiable)
    {
        return __('Invited you to new shipment.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $sender = $this->shipment->user;

        return [
            'filter' => 'shipments',
            'from_user_id' => $sender->id,
            'type' => 'DriverShipmentNewInvitationNotification',
            'title' => $this->getTitle($notifiable),
            'description' => $this->getDescription($notifiable),
            'image' => $this->getSenderImage(),
            'model_type' => Shipment::class,
            'model_id' => $this->shipment->id,
            'unread_notifications' => $notifiable->unreadNotifications->count() + 1,
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function toExpo($notifiable)
    {
        return ExpoMessage::create()
            ->title($this->getTitle($notifiable))
            ->body($this->getDescription($notifiable))
            ->setJsonData($this->toArray($notifiable))
            ->badge($notifiable->unreadNotifications->count() + 1);
    }
}
