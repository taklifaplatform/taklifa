<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Chat\Entities\ChatChannel;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Transformers\ChannelEventTransformer;
use Modules\Chat\Http\Requests\SendChannelEventRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ChannelEventController extends Controller
{
    /**
     * Send an event to the chat channel.
     */
    #[OpenApi\Operation('sendEvent', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: SendChannelEventRequest::class)]
    #[OpenApi\Response(factory: ChannelEventTransformer::class)]
    public function sendEvent(SendChannelEventRequest $request, ChatChannel $channel)
    {
        if (! $channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        return null;
    }
}
