<?php

namespace Modules\Geography\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Transformers\LocationTransformer;
use Modules\Geography\Transformers\LiveLocationTransformer;
use Modules\Geography\Http\Requests\UpdateLiveLocationRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class LiveLocationController extends Controller
{

    /**
     *  User Store Location.
     */
    #[OpenApi\Operation('updateLiveLocation', tags: ['Location'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateLiveLocationRequest::class)]
    #[OpenApi\Response(factory: UpdateLiveLocationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: LiveLocationTransformer::class)]
    public function updateLiveLocation(UpdateLiveLocationRequest $request): LocationTransformer
    {
        $user = $request->user();

        $location = $user->liveLocations()->create(
            $request->validated()
        );

        return new LocationTransformer($location);
    }
}
