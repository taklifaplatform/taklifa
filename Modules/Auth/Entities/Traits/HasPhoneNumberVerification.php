<?php

namespace Modules\Auth\Entities\Traits;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Notifications\VerifyPhoneNumberNotification;

trait HasPhoneNumberVerification
{
    /**
     * Determine if the user has verified their phone_number address.
     */
    public function hasVerifiedPhoneNumber(): bool
    {
        return ! is_null($this->phone_number_verified_at);
    }

    /**
     * Mark the given user's phone_number as verified.
     *
     * @return bool
     */
    public function markPhoneNumberAsVerified()
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone_number verification notification.
     */
    public function sendPhoneNumberVerificationNotification(): void
    {
        // generate pin code
        $pinCode = env('FAKE_PIN_CODE', false) ? 1234 : rand(100000, 999999);
        // delete old pin code
        DB::table('password_reset_tokens')
            ->where('phone_number', $this->getPhoneNumberForVerification())
            ->delete();

        // save pin code
        DB::table('password_reset_tokens')->insert([
            'phone_number' => $this->getPhoneNumberForVerification(),
            'token' => $pinCode,
            'created_at' => now(),
        ]);

        if (! env('FAKE_PIN_CODE', false)) {
            $this->notify(new VerifyPhoneNumberNotification($pinCode));
        }
    }

    /**
     * Get the phone_number address that should be used for verification.
     *
     * @return string
     */
    public function getPhoneNumberForVerification()
    {
        return $this->phone_number;
    }
}
