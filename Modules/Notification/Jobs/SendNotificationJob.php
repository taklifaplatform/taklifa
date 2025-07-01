<?php

namespace Modules\Notification\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Notification\Entities\NotificationTemplate;
use Modules\Notification\Notifications\GenericNotification;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ?NotificationTemplate $template;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public string $type,
        public User $recipient,
        public ?User $sender = null,
        public ?Model $model = null,
        public ?array $additionalData = [],
        public ?string $customMessage = null,
    ) {
        $this->template = NotificationTemplate::where('type', $type)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->template) {
            return;
        }

        $this->recipient->notify(
            new GenericNotification(
                template: $this->template,
                sender: $this->sender,
                recipient: $this->recipient,
                model: $this->model,
                additionalData: $this->additionalData,
                customMessage: $this->customMessage,
            )
        );
    }
}
