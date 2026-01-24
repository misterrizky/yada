<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            $this->addError('password', __('The provided password does not match our records.'));

            return;
        }

        session()->put('auth.password_confirmed_at', time());

        $this->redirectIntended(default: config('fortify.home', '/dashboard'), navigate: true);
    }
}; ?>

<div>
    @php
        $auth = app(\App\Settings\AppearanceSettings::class);
        $layout = $auth->layout_auth;
    @endphp

    @if($layout == "card" || $layout == "simple" || $layout == "split")
        <div class="flex flex-col gap-6">
            <x-auth-header
                :title="__('Confirm password')"
                :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
            />

            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit="confirmPassword" class="flex flex-col gap-6">
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                    {{ __('Confirm') }}
                </flux:button>
            </form>
        </div>
    @else
        <form wire:submit="confirmPassword" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_enter_email_form">
            <div class="text-center">
                <h3 class="text-lg font-medium text-mono">
                    {{ __('Confirm password') }}
                </h3>
                <span class="text-sm text-secondary-foreground">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </span>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">
                    {{ __('Password') }}
                </label>
                <input wire:model="password" class="kt-input @error('password') border-red-500 @enderror" placeholder="*********" type="password" required />
                @error('password')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Confirm') }}
                <i class="ki-filled ki-black-right"></i>
            </button>
        </form>
    @endif
</div>
