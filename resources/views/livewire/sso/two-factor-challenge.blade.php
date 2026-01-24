<?php

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\Events\TwoFactorAuthenticationFailed;
use Livewire\Volt\Component;

new class extends Component {
    public string $code = '';
    public string $recovery_code = '';
    public bool $showRecoveryInput = false;

    public function toggleRecovery(): void
    {
        $this->showRecoveryInput = ! $this->showRecoveryInput;
        $this->code = '';
        $this->recovery_code = '';
    }

    public function login(): void
    {
        if ($this->showRecoveryInput) {
            $this->validate(['recovery_code' => ['required', 'string']]);
        } else {
            $this->validate(['code' => ['required', 'string']]);
        }

        $userId = session('login.id');

        if (! $userId || ! ($user = app(config('auth.providers.users.model'))->find($userId))) {
            $this->redirectRoute('login', navigate: true);

            return;
        }

        if ($this->showRecoveryInput) {
            $valid = collect(json_decode(decrypt($user->two_factor_recovery_codes), true))
                ->contains($this->recovery_code);

            if ($valid) {
                $user->replaceRecoveryCode($this->recovery_code);
            }
        } else {
            $valid = app(TwoFactorAuthenticationProvider::class)->verify(
                decrypt($user->two_factor_secret), $this->code
            );
        }

        if ($valid) {
            Auth::guard('web')->login($user, session('login.remember', false));

            session()->forget(['login.id', 'login.remember']);

            $this->redirectIntended(default: config('fortify.home', '/dashboard'), navigate: true);
        } else {
            event(new TwoFactorAuthenticationFailed($user));

            if ($this->showRecoveryInput) {
                $this->addError('recovery_code', __('The provided recovery code was invalid.'));
            } else {
                $this->addError('code', __('The provided authentication code was invalid.'));
            }
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
            <div>
                @if(! $showRecoveryInput)
                    <x-auth-header
                        :title="__('Authentication Code')"
                        :description="__('Enter the authentication code provided by your authenticator application.')"
                    />
                @else
                    <x-auth-header
                        :title="__('Recovery Code')"
                        :description="__('Please confirm access to your account by entering one of your emergency recovery codes.')"
                    />
                @endif
            </div>

            <form wire:submit="login">
                <div class="space-y-5 text-center">
                    @if(! $showRecoveryInput)
                        <div class="flex items-center justify-center my-5">
                            <flux:otp
                                wire:model="code"
                                length="6"
                                name="code"
                                label="OTP Code"
                                label:sr-only
                                class="mx-auto"
                             />
                        </div>
                        @error('code')
                            <flux:text color="red" class="text-sm">
                                {{ $message }}
                            </flux:text>
                        @enderror
                    @else
                        <div class="my-5">
                            <flux:input
                                type="text"
                                wire:model="recovery_code"
                                autocomplete="one-time-code"
                                :placeholder="__('Recovery Code')"
                            />
                        </div>
                        @error('recovery_code')
                            <flux:text color="red" class="text-sm">
                                {{ $message }}
                            </flux:text>
                        @enderror
                    @endif

                    <flux:button
                        variant="primary"
                        type="submit"
                        class="w-full"
                    >
                        {{ __('Continue') }}
                    </flux:button>
                </div>

                <div class="mt-5 space-x-0.5 text-sm leading-5 text-center">
                    <span class="opacity-50">{{ __('or you can') }}</span>
                    <button type="button" class="inline font-medium underline cursor-pointer opacity-80" wire:click="toggleRecovery">
                        @if(! $showRecoveryInput)
                            {{ __('login using a recovery code') }}
                        @else
                            {{ __('login using an authentication code') }}
                        @endif
                    </button>
                </div>
            </form>
        </div>
    @else
        <form wire:submit="login" class="kt-card-content flex flex-col gap-5 p-10">
            <div class="text-center mb-2">
                <h3 class="text-lg font-medium text-mono mb-5">
                    @if(! $showRecoveryInput)
                        {{ __('Authentication Code') }}
                    @else
                        {{ __('Recovery Code') }}
                    @endif
                </h3>
                <span class="text-sm text-secondary-foreground mb-1.5">
                    @if(! $showRecoveryInput)
                        {{ __('Enter the authentication code provided by your authenticator application.') }}
                    @else
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    @endif
                </span>
            </div>

            <div class="flex flex-col gap-5">
                @if(! $showRecoveryInput)
                    <div class="flex flex-wrap justify-center gap-2.5">
                         <input wire:model="code" class="kt-input text-center @error('code') border-red-500 @enderror" placeholder="000000" type="text" maxlength="6" />
                    </div>
                    @error('code')
                        <span class="text-xs text-red-500 text-center">{{ $message }}</span>
                    @enderror
                @else
                    <div class="flex flex-col gap-1">
                        <input wire:model="recovery_code" class="kt-input @error('recovery_code') border-red-500 @enderror" placeholder="{{ __('Recovery Code') }}" type="text" />
                    </div>
                    @error('recovery_code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                @endif
            </div>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow mt-5">
                {{ __('Continue') }}
            </button>

            <div class="flex items-center justify-center mt-2">
                <button type="button" class="text-2sm kt-link" wire:click="toggleRecovery">
                    @if(! $showRecoveryInput)
                        {{ __('Use a recovery code') }}
                    @else
                        {{ __('Use an authentication code') }}
                    @endif
                </button>
            </div>
        </form>
    @endif
</div>
