<?php

namespace Modules\Chat\Http\Controllers;

use App\Models\User;
use Modules\Chat\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Company\Entities\Company;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Entities\ChatChannel;
use Modules\Chat\Entities\ChatMessage;
use Modules\Chat\Transformers\ChannelTransformer;
use Modules\Chat\Http\Requests\ListChannelQueryRequest;
use Modules\Chat\Transformers\SimpleChannelTransformer;
use Modules\Chat\Http\Requests\RetrieveChannelQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ChannelController extends Controller
{
    protected $chatMessagesDefaultLimit = 20;

    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation('channels', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: ListChannelQueryRequest::class)]
    #[OpenApi\Response(factory: ChannelTransformer::class, isArray: true)]
    public function channels(ListChannelQueryRequest $request)
    {
        $query = ChatChannel::query()
            ->whereHas('members', fn($query) => $query->where('user_id', $request->user()->id));

        if ($request->has('filter_conditions')) {
            $condition = $request->get('filter_conditions');

            $query->when(array_key_exists('type', $condition), function ($query) use ($condition) {
                return $query->where('type', $condition['type']);
            });
        }

        $query->with([
            'messages' => function ($query) {
                $query
                    ->latest()
                    ->where(function ($query) {
                        $query->whereNull('parent_id')
                            ->orWhere('show_in_channel', true);
                    })
                    ->limit($this->chatMessagesDefaultLimit)
                    ->withCount(ChatMessage::EAGER_LOADS_WITH_COUNT)
                    ->with(ChatMessage::EAGER_LOADS_WITH);
            },
            'members',
            'members.user',
        ]);

        return response()->json(
            [
                'channels' => $query
                    ->limit($request->get('limit', 20))
                    ->offset($request->get('offset', 20))
                    ->get()
                    ->map(fn($channel) => new ChannelTransformer($channel)),
            ]
        );
    }

    /**
     * Channel messages.
     */
    #[OpenApi\Operation('channelMessages', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: RetrieveChannelQueryRequest::class)]
    #[OpenApi\Response(factory: ChannelTransformer::class)]
    public function channelMessages(RetrieveChannelQueryRequest $request, ChatChannel $channel)
    {
        if (!$channel->members()->where('user_id', $request->user()->id)->exists()) {
            abort(403, 'You are not a member of this channel');
        }

        $limit = $this->chatMessagesDefaultLimit;
        $id_lt = null;
        if ($request->has('messages')) {
            $messagesFilter = $request->get('messages');
            if (array_key_exists('limit', $messagesFilter)) {
                $limit = $messagesFilter['limit'];
            }
            if (array_key_exists('id_lt', $messagesFilter)) {
                $id_lt = ChatMessage::extractMessageUuids($messagesFilter['id_lt']);
            }
        }

        $channel->load([
            'members',
            'members.user',
            'messages' => fn($query) => $query
                ->latest()
                ->when($id_lt, fn($query) => $query->where('id', '<', $id_lt))
                ->limit($limit)
                ->withCount(ChatMessage::EAGER_LOADS_WITH_COUNT)
                ->with(ChatMessage::EAGER_LOADS_WITH),
            'messages.user',
        ]);

        return new ChannelTransformer($channel);
    }

    /**
     * start chat.
     */
    #[OpenApi\Operation('startChat', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: SimpleChannelTransformer::class)]
    public function startChat(Request $request, string $model)
    {
        $authUser = $request->user();
        $user = User::where('id', $model)->first();

        if ($user) {
            return SimpleChannelTransformer::make(
                Chat::startChat(collect([$authUser, $user]))->channel
            );
        }

        $company = Company::findOrFail($model);
        //

        return SimpleChannelTransformer::make(
            Chat::startCompanyChat(creator: $authUser, company: $company)->channel
        );
    }
}
