<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
         public function rules(): array
    {
        return [
            'login'    => ['required', 'string'], // email, username or mobile
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    $login = $this->input('login');

    // Only allow username or mobile for login
    if (preg_match('/^[0-9]{6,15}$/', $login)) {
        // 6–15 digit phone numbers
        $field = 'mobile';
    } else {
        // Anything else treated as username
        $field = 'username';
    }

    if (! Auth::attempt([$field => $login, 'password' => $this->input('password')], $this->boolean('remember'))) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.failed'),
        ]);
    }

    RateLimiter::clear($this->throttleKey());
}


    /**
     * Prevent brute force login attempts
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::lower($this->input('login')).'|'.$this->ip();
    }
}
