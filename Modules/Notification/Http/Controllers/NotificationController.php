<?php

namespace Modules\Notification\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Notification\Transformers\NotificationTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\Notification\Http\Requests\ListNotificationQueryRequest;
use Modules\Notification\Transformers\NotificationStatusTransformer;

#[OpenApi\PathItem]
class NotificationController extends Controller
{
    /**
     * List current user notifications.
     */
    #[OpenApi\Operation('listNotifications', tags: ['Notification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListNotificationQueryRequest::class)]
    #[OpenApi\Response(factory: NotificationTransformer::class, isPagination: true)]
    public function listNotifications(ListNotificationQueryRequest $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();

        return NotificationTransformer::collection(
            $user->notifications()
                ->when(
                    $request->has('search'),
                    fn ($query) => $query->where('data->title', 'like', "%{$request->get('search')}%"),
                )
                ->paginate($request->get('per_page', 10))
        );
    }

    /**
     * Get unread notification count.
     */
    #[OpenApi\Operation('getUnreadNotificationCount', tags: ['Notification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: NotificationStatusTransformer::class)]
    public function getUnreadNotificationCount(Request $request)
    {
        return NotificationStatusTransformer::make([
            'count' => $request->user()->unreadNotifications()->count(),
        ]);
    }

    /**
     * Mark notification as read.
     */
    #[OpenApi\Operation('markAllNotificationsAsRead', tags: ['Notification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: NotificationTransformer::class)]
    public function markAllNotificationsAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return NotificationTransformer::collection($request->user()->notifications);
    }
}
