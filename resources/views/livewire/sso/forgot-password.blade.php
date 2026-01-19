<?php

use Illuminate\Support\Facades\Password;
use Livewire\Volt\Component;

new class extends Component {
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker(config('fortify.passwords'))->sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));

            $this->email = '';
        } else {
            $this->addError('email', __($status));
        }
    }
}; ?>

<div>
    @php
        $auth = app(\App\Settings\AppearanceSettings::class);
        $layout = $auth->layout_auth;
    @endphp

    @if($layout == "card" || $layout == "simple" || $layout == "split")
        <div class="flex flex-col gap-6">
            <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email Address')"
                    type="email"
                    required
                    autofocus
                    placeholder="email@example.com"
                />

                <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                    {{ __('Email password reset link') }}
                </flux:button>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
                <span>{{ __('Or, return to') }}</span>
                <flux:link :href="route('login')" wire:navigate>{{ __('log in') }}</flux:link>
            </div>
        </div>
    @else
        <form wire:submit="sendPasswordResetLink" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_enter_email_form">
            <div class="text-center">
                <h3 class="text-lg font-medium text-mono">
                    {{ __('Your Email') }}
                </h3>
                <span class="text-sm text-secondary-foreground">
                    {{ __('Enter your email to reset password') }}
                </span>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">
                    {{ __('Email') }}
                </label>
                <input wire:model="email" class="kt-input @error('email') border-red-500 @enderror" placeholder="email@email.com" type="email" required />
                @error('email')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Continue') }}
                <i class="ki-filled ki-black-right"></i>
            </button>

            <div class="text-center text-sm mt-2">
                <a href="{{ route('login') }}" class="kt-link" wire:navigate>{{ __('Back to log in') }}</a>
            </div>
        </form>
    @endif
</div>
