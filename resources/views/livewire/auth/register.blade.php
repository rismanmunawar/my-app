<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6 text-black">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <div class="form-control w-full">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800">
                    {{ __('Name') }}
                </span>
            </label>
            <input wire:model="name" type="text" required autocomplete="name" placeholder="{{ __('Full name') }}"
                class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                       focus:border-primary-500 focus:ring-primary-500
                       disabled:bg-gray-100 disabled:text-gray-400" />
        </div>

        <!-- Email -->
        <div class="form-control w-full">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800">
                    {{ __('Email address') }}
                </span>
            </label>
            <input wire:model="email" type="email" required autocomplete="email" placeholder="email@example.com"
                class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                       focus:border-primary-500 focus:ring-primary-500
                       disabled:bg-gray-100 disabled:text-gray-400" />
        </div>

        <!-- Password -->
        <div class="form-control w-full relative" x-data="{ show: false }">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800">
                    {{ __('Password') }}
                </span>
            </label>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" wire:model="password" placeholder="{{ __('Password') }}"
                    required autocomplete="new-password"
                    class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                           focus:border-primary-500 focus:ring-primary-500
                           disabled:bg-gray-100 disabled:text-gray-400 pr-10" />

                <button type="button" @click="show = !show"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-zinc-500 hover:text-zinc-800" tabindex="-1">
                    <!-- eye -->
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- eye-off -->
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.046 10.046 0 012.042-3.368M9.88 9.88a3 3 0 104.24 4.24m1.422-6.662A9.965 9.965 0 0112 5c-1.318 0-2.577.254-3.737.712M3 3l18 18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-control w-full relative" x-data="{ showConfirm: false }">
            <label class="label mb-1">
                <span class="label-text text-sm text-zinc-800">
                    {{ __('Confirm password') }}
                </span>
            </label>

            <div class="relative">
                <input :type="showConfirm ? 'text' : 'password'" wire:model="password_confirmation"
                    placeholder="{{ __('Confirm password') }}" required autocomplete="new-password"
                    class="input input-bordered w-full bg-white text-black placeholder-gray-500 border-gray-300
                           focus:border-primary-500 focus:ring-primary-500
                           disabled:bg-gray-100 disabled:text-gray-400 pr-10" />

                <button type="button" @click="showConfirm = !showConfirm"
                    class="absolute top-1/2 right-3 -translate-y-1/2 text-zinc-500 hover:text-zinc-800" tabindex="-1">
                    <!-- eye -->
                    <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- eye-off -->
                    <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.046 10.046 0 012.042-3.368M9.88 9.88a3 3 0 104.24 4.24m1.422-6.662A9.965 9.965 0 0112 5c-1.318 0-2.577.254-3.737.712M3 3l18 18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <!-- Already have account -->
    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600">
        <span>{{ __('Already have an account?') }}</span>
        <flux:link :href="route('login')" wire:navigate class="text-primary-600 hover:underline">
            {{ __('Log in') }}
        </flux:link>
    </div>
</div>
