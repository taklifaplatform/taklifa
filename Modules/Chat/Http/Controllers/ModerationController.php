<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Entities\ChatChannel;
use Modules\Chat\Entities\ChatMessage;
use Modules\Chat\Transformers\ChannelTransformer;
use Modules\Chat\Http\Requests\MuteChannelRequest;
use Modules\Chat\Http\Requests\ModerateChannelRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ModerationController extends Controller
{
    /**
     *
     */
    #[OpenApi\Operation('moderateChannel', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: ModerateChannelRequest::class)]
    #[OpenApi\Response(factory: ChannelTransformer::class)]
    public function moderateChannel(ModerateChannelRequest $request, ChatChannel $channel)
    {
        if (! $channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        // TODO: check if we gonna allow users to remove other users
        if ($request->has('remove_members')) {
            $channel->members()->whereIn('user_id', $request->get('remove_members'))->delete();
        }

        return $this->getChannelResponse($channel);
    }

    /**
     * Mute a channel.
     */
    #[OpenApi\Operation('muteChannel', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: MuteChannelRequest::class)]
    #[OpenApi\Response(factory: ChannelTransformer::class)]
    public function muteChannel(MuteChannelRequest $request)
    {
        $channelId = explode(':', $request->get('channel_cid'))[1];

        $channel = ChatChannel::findOrFail($channelId);

        if (! $channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        $channel->members()->where('user_id', $request->user()->id)->update([
            'notifications_muted' => true,
        ]);

        return $this->getChannelResponse($channel);
    }

    /**
     * Unmute a channel.
     */
    #[OpenApi\Operation('unmuteChannel', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: MuteChannelRequest::class)]
    #[OpenApi\Response(factory: ChannelTransformer::class)]
    public function unmuteChannel(MuteChannelRequest $request)
    {
        $channelId = explode(':', $request->get('channel_cid'))[1];

        $channel = ChatChannel::findOrFail($channelId);

        if (! $channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        $channel->members()->where('user_id', $request->user()->id)->update([
            'notifications_muted' => false,
        ]);

        return $this->getChannelResponse($channel);
    }

    private function getChannelResponse(ChatChannel $channel)
    {
        $channel->load([
            'members',
            'members.user',
            'messages' => fn($query) => $query
                ->latest()
                ->limit(20)
                ->withCount(ChatMessage::EAGER_LOADS_WITH_COUNT)
                ->with(ChatMessage::EAGER_LOADS_WITH),
            'messages.user',
        ]);

        return new ChannelTransformer($channel);
    }
}
