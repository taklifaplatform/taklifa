<?php

namespace Modules\Notification\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\Notification\Http\Requests\StorePushNotificationTokenRequest;

#[OpenApi\PathItem]
class ExpoPushNotificationController extends Controller
{
    /**
     * Store the Expo push notification token.
     */
    #[OpenApi\Operation('storeExpoToken', tags: ['Notification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: StorePushNotificationTokenRequest::class)]
    public function storeExpoToken(StorePushNotificationTokenRequest $request)
    {
        $request->user()->notificationDrivers()->firstOrCreate([
            'driver' => 'expo',
            'token' => $request->get('token'),
        ]);

        return $this->success('Token stored successfully');
    }
}
