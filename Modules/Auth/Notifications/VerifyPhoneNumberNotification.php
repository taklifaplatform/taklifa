<?php

namespace Modules\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Modules\Notification\Drivers\Deewan\DeewanChannel;
use Modules\Notification\Drivers\Deewan\DeewanMessage;

class VerifyPhoneNumberNotification extends Notification
{
    use Queueable;

    protected $pinCode;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pinCode)
    {
        $this->pinCode = $pinCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return [DeewanChannel::class];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     */
    public function toDeewan(object $notifiable): DeewanMessage
    {
        return (new DeewanMessage)
            ->text(
                __('Use verification code :code for :app authentication.', [
                    'code' => $this->pinCode,
                    'app' => config('app.name'),
                ])
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
