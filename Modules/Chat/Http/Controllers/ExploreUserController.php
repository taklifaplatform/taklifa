<?php

namespace Modules\Chat\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Chat\Transformers\ChatUserTransformer;
use Modules\Chat\Http\Requests\ListChatUsersQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class ExploreUserController extends Controller
{
    /**
     * Display List of Users for the chat.
     */
    #[OpenApi\Operation('listUsers', tags: ['Chat'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListChatUsersQueryRequest::class)]
    #[OpenApi\Response(factory: ChatUserTransformer::class, isPagination: true)]
    public function listUsers(ListChatUsersQueryRequest $request)
    {
        return ChatUserTransformer::collection(
            User::paginate($request->input('per_page', 10))
        );
    }
}
