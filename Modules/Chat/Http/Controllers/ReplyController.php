<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Chat\Entities\ChatMessage;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Transformers\MessageTransformer;
use Modules\Chat\Http\Requests\ListRepliesQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ReplyController extends Controller
{
    /**
     * Display List of Replies for the chat message.
     */
    #[OpenApi\Operation('listReplies', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: ListRepliesQueryRequest::class)]
    #[OpenApi\Response(factory: MessageTransformer::class, isArray: true)]
    public function listReplies(ListRepliesQueryRequest $request, $messageId)
    {
        $message = ChatMessage::findOrFail(
            ChatMessage::extractMessageUuids($messageId)
        );

        if (! $message->channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        return response()->json(
            [
                'messages' => $message
                    ->replies()
                    ->latest()
                    ->limit($request->get('limit', 20))
                    ->withCount(ChatMessage::EAGER_LOADS_WITH_COUNT)
                    ->with(ChatMessage::EAGER_LOADS_WITH)
                    ->get()
                    ->map(fn($message) => new MessageTransformer($message)),
            ]
        );
    }
}
