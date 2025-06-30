<?php

namespace Modules\Auth\Entities\Traits;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Notifications\VerifyEmailNotification;

trait HasEmailVerification
{
    /**
     * Determine if the user has verified their email address.
     */
    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        // generate pin code
        $pinCode = env('FAKE_PIN_CODE', false) ? 123456 : rand(100000, 999999);
        // delete old pin code
        DB::table('password_reset_tokens')
            ->where('email', $this->getEmailForVerification())
            ->delete();

        // save pin code
        DB::table('password_reset_tokens')->insert([
            'email' => $this->getEmailForVerification(),
            'token' => $pinCode,
            'created_at' => now(),
        ]);

        $this->notify(new VerifyEmailNotification($pinCode));
    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }
}
