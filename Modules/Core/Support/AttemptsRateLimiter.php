<?php

namespace Modules\Core\Support;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

trait AttemptsRateLimiter
{
    /**
     * Return validation error response
     */
    public function ensureIsNotRateLimited($value, int $maxAttempts = 5, int $decaySeconds = 60): void
    {
        if (env('APP_DEBUG', false)) {
            return;
        }

        RateLimiter::attempts($this->throttleKey($value));

        if (! RateLimiter::tooManyAttempts($this->throttleKey($value), $maxAttempts)) {
            RateLimiter::hit($this->throttleKey($value), $decaySeconds);

            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey($value));

        if ($seconds > 60) {
            $seconds = ceil($seconds / 60).' '.__('minutes');
        } else {
            $seconds = $seconds.' '.__('seconds');
        }

        $response = [
            'message' => __('Too many attempts, Please try again in :seconds', [
                'seconds' => $seconds,
            ]),
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }

    /**
     * Clear the rate limiter for the given key.
     */
    public function clearRateLimiter($value): void
    {
        RateLimiter::clear($this->throttleKey($value));
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey($value): string
    {
        return Str::transliterate(Str::lower($value).'|'.request()->ip());
    }
}
