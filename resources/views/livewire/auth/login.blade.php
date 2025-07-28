<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div class="form-control w-full">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800 ">
                    {{ __('Email address') }}
                </span>
            </label>
            <input type="email" wire:model="email" placeholder="email@example.com" required autofocus
                autocomplete="email"
                class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                   focus:border-primary-500 focus:ring-primary-500
                   disabled:bg-gray-100 disabled:text-gray-400" />
        </div>

        <!-- Password -->
        @php $showPassword = false; @endphp

        <div class="form-control w-full relative" x-data="{ show: false }">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800">
                    {{ __('Password') }}
                </span>
            </label>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model="password" placeholder="{{ __('Password') }}"
                    required autocomplete="current-password"
                    class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                   focus:border-primary-500 focus:ring-primary-500
                   disabled:bg-gray-100 disabled:text-gray-400 pr-10" />

                <button type="button" @click="show = !show"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-zinc-500 hover:text-zinc-800" tabindex="-1">
                    <!-- Hidden when 'show' is true -->
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Shown when 'show' is true -->
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.046 10.046 0 012.042-3.368M9.88 9.88a3 3 0 104.24 4.24m1.422-6.662A9.965 9.965 0 0112 5c-1.318 0-2.577.254-3.737.712M3 3l18 18" />
                    </svg>
                </button>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="absolute end-0 -bottom-6 text-sm text-zinc-600 hover:underline" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>


        <!-- Remember Me -->
        <div class="form-control">
            <label class="cursor-pointer label">
                <input type="checkbox" wire:model="remember" class="checkbox checkbox-primary me-2" />
                <span class="label-text text-sm text-zinc-800">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Log in') }}
            </button>
        </div>
    </form>


    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
        </div>
    @endif
</div>
