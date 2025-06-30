<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Api\Attributes as OpenApi;
use Modules\Core\Libraries\ValidationMessage;
use Modules\Auth\Http\Requests\ResetPasswordRequest;
use Modules\Auth\Http\Requests\SendResetPasswordPinCodeRequest;
use Modules\Auth\Http\Requests\VerifyResetPasswordPinCodeRequest;

#[OpenApi\PathItem]
class ResetPasswordController extends Controller
{
    /**
     * Send a reset password mail to the given phone_number address.
     */
    #[OpenApi\Operation('sendResetPasswordPinCode', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: SendResetPasswordPinCodeRequest::class)]
    #[OpenApi\Response(factory: SendResetPasswordPinCodeRequest::class)]
    public function sendResetPasswordPinCode(SendResetPasswordPinCodeRequest $request)
    {
        // send mail to user
        $user = User::where('phone_number', $request->phone_number)->first();

        // generate pin code
        $pinCode = env('FAKE_PIN_CODE', false) ? 123456 : rand(100000, 999999);

        // delete old pin code
        DB::table('password_reset_tokens')
            ->where('phone_number', $user->phone_number)
            ->delete();

        // save pin code to database
        DB::table('password_reset_tokens')->insert([
            'phone_number' => $user->phone_number,
            'token' => $pinCode,
            'created_at' => Carbon::now(),
        ]);

        // send mail to user
        if (! env('FAKE_PIN_CODE', false)) {
            $user->notify(new \Modules\Auth\Notifications\ResetPasswordNotification($pinCode));
        }

        // TODO:: track user activity
        // $user->trackActivity('reset_password_pin_code_sent');

        return $this->success(__('Reset password pin code sent successfully'));
    }

    /**
     * Verify the given user's phone_number address with pin code.
     */
    #[OpenApi\Operation('verifyResetPasswordPinCode', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: VerifyResetPasswordPinCodeRequest::class)]
    #[OpenApi\Response(factory: VerifyResetPasswordPinCodeRequest::class)]
    public function verifyResetPasswordPinCode(VerifyResetPasswordPinCodeRequest $request)
    {
        // check if pin code is valid
        $builder = DB::table('password_reset_tokens')
            ->where('phone_number', $request->phone_number)
            ->where('token', $request->pin_code);

        if ($builder->get()->isEmpty()) {
            return $this->invalid(new ValidationMessage(
                'pin_code',
                __('Invalid PIN Code')
            ));
        }

        return $this->success(__('PIN Code verified successfully'));
    }

    /**
     * Reset the password for the given token.
     */
    #[OpenApi\Operation('resetPassword', tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: ResetPasswordRequest::class)]
    #[OpenApi\Response(factory: ResetPasswordRequest::class, statusCode: 422)]
    public function resetPassword(ResetPasswordRequest $request)
    {
        // check if pin code is valid
        $builder = DB::table('password_reset_tokens')
            ->where('phone_number', $request->phone_number)
            ->where('token', $request->pin_code);

        if ($builder->get()->isEmpty()) {
            return $this->invalid(new ValidationMessage(
                'pin_code',
                __('Invalid PIN Code')
            ));
        }

        // delete pin code
        $builder->delete();

        // update user password
        $user = User::where('phone_number', $request->phone_number)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // track activity

        return $this->success(__('Password reset successfully'));
    }
}
