<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Core\Libraries\ValidationMessage;
use Modules\Auth\Transformers\AuthTokenTransformer;

#[OpenApi\PathItem]
class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    #[OpenApi\Operation('login', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: LoginRequest::class)]
    #[OpenApi\Response(factory: LoginRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: AuthTokenTransformer::class)]
    public function store(LoginRequest $request)
    {
        $this->ensureIsNotRateLimited($request->email);

        if (! ($user = User::where('phone_number', $request->get('phone_number'))->first())) {
            return $this->returnInvalidEmailResponse();
        }

        if ($this->invalidPassword($user, $request)) {
            return $this->returnInvalidPasswordResponse();
        }

        $newAccessToken = $this->login($user);

        $this->clearRateLimiter($request->email);

        return new AuthTokenTransformer($newAccessToken);
    }

    /**
     * Check if the entered password is valid or not
     *
     * @param  User  $admin
     * @param  LoginRequest  $request
     */
    protected function invalidPassword(User $user, $request): bool
    {
        // if no password is set for admin, it means the
        // provided password cannot be accepted at all
        if (! $user->password) {
            return true;
        }

        return ! Hash::check(
            $request->get('password'),
            $user->password
        );
    }

    /**
     * Return an error response stating that the given
     * email is invalid
     */
    protected function returnInvalidEmailResponse()
    {
        return $this->invalid(new ValidationMessage(
            'phone_number',
            __('auth.failed')
        ));
    }

    /**
     * Return an error response stating that the given
     * password is invalid
     */
    protected function returnInvalidPasswordResponse()
    {
        return $this->invalid(new ValidationMessage('password'));
    }

    /**
     * Destroy an authenticated session.
     */
    #[OpenApi\Operation('logout', tags: ['Auth'])]
    public function destroy(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(null, 200);
    }
}
