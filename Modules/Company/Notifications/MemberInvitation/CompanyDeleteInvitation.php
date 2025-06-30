<?php

namespace Modules\Company\Notifications\MemberInvitation;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Modules\Company\Entities\CompanyInvitation;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyDeleteInvitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public CompanyInvitation $companyInvitation
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Company Driver Invitation Delete')
            ->line('Your company driver invitation request has been deleted');
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
