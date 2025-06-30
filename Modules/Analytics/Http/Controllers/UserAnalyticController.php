<?php

namespace Modules\Analytics\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Api\Attributes as OpenApi;
use Modules\Analytics\Entities\UserAnalytic;
use Modules\Analytics\Transformers\UserAnalyticTransformer;
use Modules\Analytics\Http\Requests\UpdateUserAnalyticRequest;
use Modules\Analytics\Http\Requests\ListUserAnalyticRequest;

#[OpenApi\PathItem]
class UserAnalyticController extends Controller
{
    /**
     * Store new user analytic.
     */
    #[OpenApi\Operation('storeUserAnalytic', tags: ['Analytics'])]
    #[OpenApi\RequestBody(factory: UpdateUserAnalyticRequest::class)]
    #[OpenApi\Response(factory: UpdateUserAnalyticRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: UserAnalyticTransformer::class)]
    public function storeUserAnalytic(UpdateUserAnalyticRequest $request, User $user)
    {
        $validated = $request->validated();
        $viewerId = $request->user()?->id ?? null;

        $userAnalytic = UserAnalytic::create([
            ...$validated,
            'user_id' => $user->id,
            'viewer_id' => $viewerId,
            'count' => 1,
            'ip_address' => $request->ip(),
        ]);

        return UserAnalyticTransformer::make($userAnalytic);
    }

    /**
     * Get user analytics.
     */
    #[OpenApi\Operation('getUserAnalytics', tags: ['Analytics'])]
    #[OpenApi\Response(factory: UserAnalyticTransformer::class, isArray: true)]
    #[OpenApi\Parameters(factory: ListUserAnalyticRequest::class)]
    public function getUserAnalytics(ListUserAnalyticRequest $request)
    {
        $user = $request->route('user');
        $userAnalytics = UserAnalytic::where('user_id', $user)->get();

        return UserAnalyticTransformer::collection($userAnalytics);
    }
}
