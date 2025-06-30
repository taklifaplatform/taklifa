<?php

namespace Modules\Geography\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Location;
use Modules\Geography\Transformers\LocationTransformer;
use Modules\Geography\Http\Requests\UpdateLocationRequest;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class LocationController extends Controller
{
    /**
     *  Retrieve Location.
     */
    #[OpenApi\Operation('retrieve', tags: ['Location'])]
    #[OpenApi\Response(factory: LocationTransformer::class)]
    public function retrieve(Location $location): LocationTransformer
    {
        return new LocationTransformer($location);
    }

    /**
     *  User Store Location.
     */
    #[OpenApi\Operation('create', tags: ['Location'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateLocationRequest::class)]
    #[OpenApi\Response(factory: UpdateLocationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: LocationTransformer::class)]
    public function create(UpdateLocationRequest $request): LocationTransformer
    {
        $user = $request->user();

        $location = $user->locations()->create(
            $request->validated()
        );

        $location->creator_id = $user->id;
        $location->save();

        return new LocationTransformer($location);
    }

    /**
     *  User Update Location.
     */
    #[OpenApi\Operation('update', tags: ['Location'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateLocationRequest::class)]
    #[OpenApi\Response(factory: UpdateLocationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: LocationTransformer::class)]
    public function update(UpdateLocationRequest $request, Location $location): LocationTransformer
    {
        $user = $request->user();

        // TODO:: security check
        if ($location->locationable_id !== $user->id && !$user->companies()->find($location->locationable_id)) {
            abort(403, __('You are not authorized to perform this action'));
        }

        $location->update(
            $request->validated()
        );

        return new LocationTransformer($location);
    }
}
