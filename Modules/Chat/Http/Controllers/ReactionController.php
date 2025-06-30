<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Chat\Entities\ChatMessage;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Events\ChatMessageUpdatedEvent;
use Modules\Chat\Transformers\MessageTransformer;
use Modules\Chat\Http\Requests\UpdateReactionRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ReactionController extends Controller
{
    /**
     * Create a reaction for a message.
     */
    #[OpenApi\Operation('createReaction', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateReactionRequest::class)]
    #[OpenApi\Response(factory: MessageTransformer::class)]
    public function createReaction(UpdateReactionRequest $request, $messageId)
    {
        $user_id = $request->user()->id;

        $reactionData = $request->get('reaction');

        $message = ChatMessage::findOrFail(
            ChatMessage::extractMessageUuids($messageId)
        );

        if (! $message->channel->members()->where('user_id', $user_id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        if ($request->get('enforce_unique')) {
            $message->reactions()->where('user_id', $user_id)->delete();
        }

        $message->reactions()->updateOrCreate(
            [
                'user_id' => $user_id,
                'type' => $reactionData['type'],
            ],
            $reactionData
        );

        $message = $this->recalculateReactionCounts($message);

        $message->load(ChatMessage::EAGER_LOADS_WITH);
        $message->loadCount(ChatMessage::EAGER_LOADS_WITH_COUNT);

        event(
            new ChatMessageUpdatedEvent($message->id)
        );

        return MessageTransformer::make(
            $message
        );
    }

    /**
     * Recalculate the reaction counts for a message.
     */
    private function recalculateReactionCounts(ChatMessage $message)
    {
        $reactionCounts = $message->reactions->groupBy('type')->map->count();
        $reactionScores = $message->reactions->groupBy('type')->map->sum('score');

        $message->reaction_counts = $reactionCounts;
        $message->reaction_scores = $reactionScores;

        $message->save();

        return $message;
    }
}
