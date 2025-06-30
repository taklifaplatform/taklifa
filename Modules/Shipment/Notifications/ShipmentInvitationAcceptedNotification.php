<?php

namespace Modules\Shipment\Notifications;

use Illuminate\Bus\Queueable;
use Modules\Shipment\Entities\Shipment;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Shipment\Entities\ShipmentInvitation;
use Modules\Notification\Drivers\Expo\ExpoChannel;
use Modules\Notification\Drivers\Expo\ExpoMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class ShipmentInvitationAcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public Shipment $shipment,
        public ShipmentInvitation $shipmentInvitation
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
        if ($this->shipmentInvitation->driver) {
            return $this->shipmentInvitation->driver->getFirstMedia('avatar');
        }

        return $this->shipmentInvitation->company->getFirstMedia('logo');
    }

    public function getSenderName()
    {
        if ($this->shipmentInvitation->driver) {
            return $this->shipmentInvitation->driver->name;
        }

        return $this->shipmentInvitation->company->name;
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
        return __('Accepted your shipment invitation');
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
            'type' => 'ShipmentInvitationAcceptedNotification',
            'title' => $this->getTitle($notifiable),
            'description' => $this->getDescription($notifiable),
            'image' => $this->getSenderImage(),
            'model_type' => ShipmentInvitation::class,
            'model_id' => $this->shipmentInvitation->id,
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
