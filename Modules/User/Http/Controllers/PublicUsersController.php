<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\User\Transformers\UserTransformer;
use Modules\User\Http\Requests\ListUsersQueryRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class PublicUsersController extends Controller
{
    /**
     *  Fetch all users.
     */
    #[OpenApi\Operation('fetchAllUsers', tags: ['Users'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: UserTransformer::class, isPagination: true)]
    #[OpenApi\Parameters(factory: ListUsersQueryRequest::class)]
    public function fetchAllUsers(ListUsersQueryRequest $request)
    {
        return UserTransformer::collection(
            User::query()
                ->when($request->search, static function ($query, $search): void {
                    $query->where('name', 'like', sprintf('%%%s%%', $search));
                })
                ->paginate($request->per_page ?? 10)
        );
    }

    /**
     *  Retrieve a user.
     */
    #[OpenApi\Operation('retrieveUser', tags: ['Users'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: UserTransformer::class)]
    public function retrieveUser(User $user): UserTransformer
    {
        return new UserTransformer($user);
    }
}
