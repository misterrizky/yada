<?php

use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Support\Facades\Password;
use Livewire\Volt\Component;

new class extends Component {
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(?string $token = null): void
    {
        $this->token = $token ?? request()->route('token') ?? request()->query('token', '');
        $this->email = request()->query('email', '');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $status = Password::broker(config('fortify.passwords'))->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ],
            function ($user, $password) {
                app(ResetUserPassword::class)->reset($user, ['password' => $password, 'password_confirmation' => $this->password_confirmation]);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __($status));

            $this->redirectRoute('login', navigate: true);
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
            <x-auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit="resetPassword" class="flex flex-col gap-6">
                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email')"
                    type="email"
                    required
                    autocomplete="email"
                />

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full" data-test="reset-password-button">
                        {{ __('Reset password') }}
                    </flux:button>
                </div>
            </form>
        </div>
    @else
        <form wire:submit="resetPassword" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_change_password_form">
            <div class="text-center">
                <h3 class="text-lg font-medium text-mono">
                    {{ __('Reset Password') }}
                </h3>
                <span class="text-sm text-secondary-foreground">
                    {{ __('Enter your new password') }}
                </span>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">
                    {{ __('Email') }}
                </label>
                <input wire:model="email" class="kt-input @error('email') border-red-500 @enderror" type="email" required />
                @error('email')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">
                    {{ __('New Password') }}
                </label>
                <label class="kt-input @error('password') border-red-500 @enderror" data-kt-toggle-password="true">
                    <input wire:model="password" placeholder="{{ __('Enter a new password') }}" type="password" required />
                </label>
                @error('password')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">
                    {{ __('Confirm New Password') }}
                </label>
                <label class="kt-input @error('password_confirmation') border-red-500 @enderror" data-kt-toggle-password="true">
                    <input wire:model="password_confirmation" placeholder="{{ __('Re-enter a new Password') }}" type="password" required />
                </label>
            </div>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Submit') }}
            </button>
        </form>
    @endif
</div>
