<?php

namespace Modules\UserVerification\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Geography\Entities\Location;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;
use Modules\UserVerification\Http\Requests\DriverVerificationRequest;
use Modules\UserVerification\Transformers\UserVerificationTransformer;
use Modules\UserVerification\Http\Requests\UpdateUserVerificationRequest;

#[OpenApi\PathItem]
class UserVerificationController extends Controller
{
    /**
     * Display the authenticated user verification.
     */
    #[OpenApi\Operation('retrieveUserVerification', tags: ['User Verification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: UserVerificationTransformer::class)]
    public function show(Request $request): UserVerificationTransformer
    {
        $userVerification = $request->user()->verification()->firstOrCreate();

        return new UserVerificationTransformer($userVerification);
    }

    /**
     * Store a new user verification for the authenticated user.
     */
    #[OpenApi\Operation('storeUserVerification', tags: ['User Verification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateUserVerificationRequest::class)]
    #[OpenApi\Response(factory: UpdateUserVerificationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: UserVerificationTransformer::class)]
    public function storeUserVerification(UpdateUserVerificationRequest $request): UserVerificationTransformer
    {
        $user = $request->user();
        $userVerification = $user->verification()->firstOrCreate();

        $userVerification->update(
            $request->validated()
        );

        $location = Location::find($request->location_id);
        if ($location) {
            $newLocation = $user->locations()->create([
                ...$location->toArray(),
            ]);
            $newLocation->creator_id = $user->id;
            $newLocation->save();
            $user->location_id = $newLocation->id;
            $user->save();
        }

        if ($request->has('name')) {
            $user->update([
                'name' => $request->get('name'),
            ]);
        }

        $this->addSingleMedia($userVerification, $request->get('identity_card'), 'identity_card');

        return new UserVerificationTransformer($userVerification);
    }

    /**
     * Store a new driver verification for the authenticated user.
     */
    #[OpenApi\Operation('storeDriverVerification', tags: ['User Verification'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: DriverVerificationRequest::class)]
    #[OpenApi\Response(factory: DriverVerificationRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: UserVerificationTransformer::class)]
    public function storeDriverVerification(DriverVerificationRequest $request): UserVerificationTransformer
    {
        $user = $request->user();
        $userVerification = $user->verification()->firstOrCreate();

        $userVerification->update(
            $request->validated()
        );

        if (!$user->name && $request->has('name')) {
            $user->update([
                'name' => $request->get('name'),
            ]);
        }

        $this->addSingleMedia($userVerification, $request->get('driving_license_card'), 'driving_license_card');
        $this->addSingleMedia($userVerification, $request->get('assurance_card'), 'assurance_card');

        // assign the user to the driver role
        $user->assignRole('solo_driver');
        $user->setActiveRole('solo_driver');

        return new UserVerificationTransformer($userVerification);
    }
}
