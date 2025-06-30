<?php

namespace Modules\Chat\Providers;

use Modules\Chat\Events\ChatMessageCreatedEvent;
use Modules\Chat\Listeners\ChatMessageCreatedEventListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ChatEventsProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ChatMessageCreatedEvent::class => [
            ChatMessageCreatedEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
