<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Http\Requests\UpdateEmailRequest;
use Modules\User\Http\Requests\UpdatePasswordRequest;
use Modules\User\Http\Requests\ChangeActiveRoleRequest;
use Modules\User\Http\Requests\UpdatePhoneNumberRequest;
use Modules\User\Http\Requests\UpdateUserLocationRequest;
use Modules\User\Transformers\AuthenticatedUserTransformer;
use Modules\Auth\OpenApi\SecuritySchemes\BearerTokenSecurityScheme;

#[OpenApi\PathItem]
class UserController extends Controller
{
    /**
     * Retrieve the authenticated user.
     */
    #[OpenApi\Operation('retrieveUser', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function retrieveUser(Request $request): AuthenticatedUserTransformer
    {
        return new AuthenticatedUserTransformer($request->user());
    }

    /**
     * Update the authenticated user location.
     */
    #[OpenApi\Operation('updateLocation', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateUserLocationRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function updateLocation(UpdateUserLocationRequest $request): AuthenticatedUserTransformer
    {
        $user = $request->user();

        $user->location_id = $request->get('location_id');
        $user->save();


        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Update the authenticated user.
     */
    #[OpenApi\Operation('updateUser', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateUserRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function update(UpdateUserRequest $request): AuthenticatedUserTransformer
    {
        $user = $request->user();

        $user->update($request->validated());

        $this->addSingleMedia($user, $request->get('avatar'), 'avatar');

        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Update User password .
     */
    #[OpenApi\Operation('updatePassword', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdatePasswordRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();

        $user->password = bcrypt($request->get('password'));

        if ($user->save()) {
            return new AuthenticatedUserTransformer($user);
        }

        abort(403, __('Oops, Something went wrong!'));
    }

    /**
     * Update User email .
     */
    #[OpenApi\Operation('updateEmail', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateEmailRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function updateEmail(UpdateEmailRequest $request)
    {
        $user = $request->user();

        $user->email = $request->get('email');

        $user->save();

        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Update User phone number .
     */
    #[OpenApi\Operation('updatePhoneNumber', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdatePhoneNumberRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function updatePhoneNumber(UpdatePhoneNumberRequest $request)
    {
        $user = $request->user();

        $user->phone_number = $request->get('phone_number');

        $user->save();

        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Activate a role for the authenticated user.
     */
    #[OpenApi\Operation('changeActiveRole', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: ChangeActiveRoleRequest::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function changeActiveRole(ChangeActiveRoleRequest $request)
    {
        $user = $request->user();

        $user->setActiveRole($request->get('name'));

        /**
         * when user change the role, we need to remove the active company
         */
        $user->active_company_id = null;
        $user->save();

        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Delete User Account.
     */
    #[OpenApi\Operation('deleteAccount', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function deleteAccount(Request $request)
    {
        $user = $request->user();
        // delete all services for this user
        $user->services()->delete();
        $user->delete();

        return new AuthenticatedUserTransformer($user);
    }

    /**
     * Enable Customer Role.
     */
    #[OpenApi\Operation('enableCustomerRole', tags: ['User'], security: BearerTokenSecurityScheme::class)]
    #[OpenApi\Response(factory: AuthenticatedUserTransformer::class)]
    public function enableCustomerRole(Request $request)
    {
        $user = $request->user();

        if (!$user->hasRole('customer')) {
            $user->assignRole('customer');
        }

        return new AuthenticatedUserTransformer($user);
    }
}
