<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Core\Libraries\ValidationMessage;
use Modules\Auth\Transformers\AuthTokenTransformer;
use Modules\Auth\Http\Requests\VerifyPhoneNumberRequest;
use Modules\Auth\Http\Requests\SendPhoneNumberVerificationPinCodeRequest;

#[OpenApi\PathItem]
class VerifyPhoneNumberController extends Controller
{
    /**
     * Verify the given user's phone number with pin code.
     */
    #[OpenApi\Operation('verifyPhoneNumber', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: VerifyPhoneNumberRequest::class)]
    #[OpenApi\Response(factory: VerifyPhoneNumberRequest::class, statusCode: 422)]
    #[OpenApi\Response(factory: AuthTokenTransformer::class)]
    public function verifyPhoneNumber(VerifyPhoneNumberRequest $request)
    {
        $this->ensureIsNotRateLimited($request->phone_number);

        $builder = DB::table('password_reset_tokens')
            ->where('phone_number', $request->phone_number)
            ->where('token', $request->pin_code);

        if ($builder->get()->isEmpty()) {
            return $this->invalid(new ValidationMessage(
                'pin_code',
                __('Invalid PIN Code')
            ));
        }

        $builder->delete();

        $user = User::where('phone_number', $request->phone_number)->firstOrFail();
        $user->phone_number_verified_at = now();
        $user->save();

        $this->clearRateLimiter($request->phone_number);

        $newAccessToken = $this->login($user);

        return new AuthTokenTransformer($newAccessToken);
    }

    /**
     * Send a verification phone number to the user with the given phone number.
     */
    #[OpenApi\Operation('sendPhoneNumberVerification', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: SendPhoneNumberVerificationPinCodeRequest::class)]
    #[OpenApi\Response(factory: SendPhoneNumberVerificationPinCodeRequest::class)]
    public function sendPhoneNumberVerification(SendPhoneNumberVerificationPinCodeRequest $request)
    {
        $this->ensureIsNotRateLimited(
            $request->phone_number,
        );

        $user = User::where('phone_number', $request->phone_number)->first();

        if ($user->hasVerifiedPhoneNumber()) {
            return $this->invalid(new ValidationMessage(
                'phone_number',
                __('phone_number already verified')
            ));
        }

        $user->sendPhoneNumberVerificationNotification();

        return $this->success(__('Phone number verification code sent successfully'));
    }
}
