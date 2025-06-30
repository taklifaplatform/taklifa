<?php

namespace Modules\Chat\Http\Controllers;

use Modules\Chat\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Entities\ChatChannel;
use Modules\Chat\Entities\ChatMessage;
use Modules\Chat\Transformers\MessageTransformer;
use Modules\Chat\Http\Requests\UpdateMessageRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class MessageController extends Controller
{
    /**
     * Create a new message in the chat channel.
     */
    #[OpenApi\Operation('createMessage', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateMessageRequest::class)]
    #[OpenApi\Response(factory: MessageTransformer::class)]
    public function createMessage(UpdateMessageRequest $request, ChatChannel $channel)
    {
        return $this->getMessageTransformer(
            Chat::channel($channel)
                ->forUser($request->user())
                ->sendMessage($request->get('message'))
        );
    }

    /**
     * Update a message in the chat channel.
     */
    #[OpenApi\Operation('updateMessage', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateMessageRequest::class)]
    #[OpenApi\Response(factory: MessageTransformer::class)]
    public function updateMessage(UpdateMessageRequest $request, $messageId)
    {
        $message = ChatMessage::findOrFail(
            ChatMessage::extractMessageUuids($messageId)
        );

        return $this->getMessageTransformer(
            Chat::channel($message->channel)
                ->forUser($request->user())
                ->updateMessage($message, $request->get('message'))
        );
    }

    /**
     * Patch a message in the chat channel.
     */
    #[OpenApi\Operation('patchMessage', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateMessageRequest::class)]
    #[OpenApi\Response(factory: MessageTransformer::class)]
    public function patchMessage(UpdateMessageRequest $request, $messageId)
    {
        $message = ChatMessage::findOrFail(
            ChatMessage::extractMessageUuids($messageId)
        );

        return $this->getMessageTransformer(
            Chat::channel($message->channel)
                ->forUser($request->user())
                ->updateMessage($message, $request->get('message'))
        );
    }

    /**
     * Delete a message in the chat channel.
     */
    #[OpenApi\Operation('deleteMessage', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: MessageTransformer::class)]
    public function deleteMessage(Request $request, $messageId)
    {
        $message = ChatMessage::findOrFail(
            ChatMessage::extractMessageUuids($messageId)
        );

        return $this->getMessageTransformer(
            Chat::channel($message->channel)
                ->forUser($request->user())
                ->deleteMessage($message)
        );
    }

    private function getMessageTransformer(ChatMessage $chatMessage)
    {
        $chatMessage->load(ChatMessage::EAGER_LOADS_WITH);
        $chatMessage->loadCount(ChatMessage::EAGER_LOADS_WITH_COUNT);

        return MessageTransformer::make(
            $chatMessage
        );
    }
}
