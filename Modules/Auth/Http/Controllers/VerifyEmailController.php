<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Core\Libraries\ValidationMessage;
use Modules\Auth\Http\Requests\VerifyEmailRequest;
use Modules\Auth\Http\Requests\SendEmailVerificationPinCodeRequest;

#[OpenApi\PathItem]
class VerifyEmailController extends Controller
{
    /**
     * Verify the given user's email address with pin code.
     */
    #[OpenApi\Operation('verifyEmail', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: VerifyEmailRequest::class)]
    #[OpenApi\Response(factory: VerifyEmailRequest::class, statusCode: 422)]
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $this->ensureIsNotRateLimited($request->email);

        $builder = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->pin_code);

        if ($builder->get()->isEmpty()) {
            return $this->invalid(new ValidationMessage(
                'token',
                __('Invalid PIN Code')
            ));
        }

        $builder->delete();

        $user = User::where('email', $request->email)->firstOrFail();
        $user->email_verified_at = now();
        $user->save();

        $this->clearRateLimiter($request->email);

        return $this->success(__('Email verified successfully'));
    }

    /**
     * Send a verification email to the user with the given email address.
     */
    #[OpenApi\Operation('sendEmailVerification', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: SendEmailVerificationPinCodeRequest::class)]
    #[OpenApi\Response(factory: SendEmailVerificationPinCodeRequest::class)]
    public function sendEmailVerification(SendEmailVerificationPinCodeRequest $request)
    {
        $this->ensureIsNotRateLimited(
            $request->email,
        );

        $user = User::where('email', $request->email)->first();

        if ($user->hasVerifiedEmail()) {
            return $this->invalid(new ValidationMessage(
                'email',
                __('Email already verified')
            ));
        }

        $user->sendEmailVerificationNotification();

        return $this->success(__('Verification email sent successfully'));
    }
}
