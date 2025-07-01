<?php

namespace Modules\Notification\Notifications;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Notification\Drivers\Expo\ExpoChannel;
use Modules\Notification\Drivers\Expo\ExpoMessage;
use Modules\Notification\Drivers\Deewan\DeewanChannel;
use Modules\Notification\Drivers\Deewan\DeewanMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Modules\Notification\Entities\NotificationTemplate;

class GenericNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public int $currentUnreadNotificationsCount;
    public int $newUnreadNotificationsCount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        public NotificationTemplate $template,
        public User $recipient,
        public ?User $sender = null,
        public ?Model $model = null,
        public ?array $additionalData = [],
        public ?string $customMessage = null,
    ) {
        $this->currentUnreadNotificationsCount = (int) $recipient->unreadNotifications->count();
        $this->newUnreadNotificationsCount = $this->currentUnreadNotificationsCount + 1;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];

        if ($this->template->email_notification) {
            $channels[] = 'mail';
        }

        if ($this->template->push_notification) {
            $channels[] = ExpoChannel::class;
        }

        if ($this->template->db_notification) {
            $channels[] = 'database';
        }

        if ($this->template->sms_notification) {
            $channels[] = DeewanChannel::class;
        }

        return $channels;
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
            ->subject($this->replaceVariables($this->template->email_notification_subject))
            ->greeting($this->replaceVariables($this->template->email_notification_title))
            ->line($this->customMessage ?? $this->replaceVariables($this->template->email_notification_description));
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     */
    public function toDeewan(object $notifiable): DeewanMessage
    {
        $message = $this->replaceVariables($this->template->sms_notification_title) . "\n\n" . $this->replaceVariables($this->template->sms_notification_description);

        return (new DeewanMessage)
            ->text($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->replaceVariables($this->template->db_notification_title),
            'description' => $this->customMessage ?? $this->replaceVariables($this->template->db_notification_description),
            'sender_id' => $this->sender?->id,
            'template_id' => $this->template->id,
            'template_type' => $this->template->type,
            'model_id' => $this->model?->id,
            'model_type' => $this->model ? $this->model::class : null,

            'icon' => $this->template->icon,
            'icon_rounded' => $this->template->icon_rounded,
            'icon_user_avatar' => $this->template->icon_user_avatar,

            'notification_counts' => $this->newUnreadNotificationsCount,
            'current_notification_counts' => $this->currentUnreadNotificationsCount,
            ...$this->additionalData,
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
            ->title($this->replaceVariables($this->template->push_notification_title))
            ->body($this->customMessage ?? $this->replaceVariables($this->template->push_notification_description))
            ->setJsonData($this->toArray($notifiable))
            ->badge($this->newUnreadNotificationsCount);
    }

    public function replaceVariables(?string $text)
    {
        if (! $text) {
            return $text;
        }
        $variables = [
            //
            '{SENDER_NAME}' => $this->sender?->name ?? $this->sender?->username ?? $this->sender?->phone_number,
            '{SENDER_EMAIL}' => $this->sender?->email,
            '{SENDER_PHONE}' => $this->sender?->phone_number,

            '{RECIPIENT_NAME}' => $this->recipient?->name,
            '{RECIPIENT_EMAIL}' => $this->recipient?->email,
            '{RECIPIENT_PHONE}' => $this->recipient?->phone_number,

            "{MODEL_URL}" => method_exists($this->model, 'getUrl') ? $this->model->getUrl() : null,


        ];

        foreach ($variables as $key => $value) {
            if ($value === null) {
                continue;
            }
            $text = str_replace($key, $value, $text);
        }

        return $text;
    }
}
