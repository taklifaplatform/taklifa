<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Illuminate\Auth\Events\Registered;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Transformers\AuthTokenTransformer;
use Illuminate\Support\Str;

#[OpenApi\PathItem]
class RegisterController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    #[OpenApi\Operation('register', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: RegisterRequest::class)]
    #[OpenApi\Response(factory: RegisterRequest::class)]
    #[OpenApi\Response(factory: AuthTokenTransformer::class)]
    public function store(RegisterRequest $request): AuthTokenTransformer
    {
        // avoid users spamming accounts, limiting to 1 account per 5 minutes.
        $this->ensureIsNotRateLimited($request->ip(), 1, 60 * 5);

        /**
         * In case user registration failed before, we will allow them to register again
         */
        if (! $user = User::where('phone_number', $request->phone_number)->whereNull('phone_number_verified_at')->first()) {
            // create new user
            $user = new User();
        }

        // if no username, generate one from name and add phone number
        if ($request->name) {
            $user->username = Str::slug($request->name . ' ' . $request->phone_number);
        } else {
            $user->username = $request->phone_number;
        }

        $user->forceFill([
            ...$request->only('name', 'phone_number', 'email'),
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        if ($request->is_customer) {
            if (! $user->hasRole('customer')) {
                $user->assignRole('customer');
            }

            $user->setActiveRole('customer');
        }

        event(new Registered($user));

        // send sms verification code
        $user->sendPhoneNumberVerificationNotification();

        $token = $this->login($user);

        return new AuthTokenTransformer($token);
    }
}
