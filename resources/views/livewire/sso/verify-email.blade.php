<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public function resend(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: config('fortify.home', '/dashboard'), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div>
    @php
        $auth = app(\App\Settings\AppearanceSettings::class);
        $layout = $auth->layout_auth;
    @endphp

    @if($layout == "card" || $layout == "simple" || $layout == "split")
        <div class="mt-4 flex flex-col gap-6">
            <flux:text class="text-center">
                {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
            </flux:text>

            @if (session('status') == 'verification-link-sent')
                <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </flux:text>
            @endif

            <div class="flex flex-col items-center justify-between space-y-3">
                <form wire:submit="resend">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Resend verification email') }}
                    </flux:button>
                </form>

                <form wire:submit="logout">
                    <flux:button variant="ghost" type="submit" class="text-sm cursor-pointer" data-test="logout-button">
                        {{ __('Log out') }}
                    </flux:button>
                </form>
            </div>
        </div>
    @else
        <div class="kt-card-content p-10">
            <div class="flex justify-center py-10">
                <img alt="image" class="dark:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30.svg') }}"/>
                <img alt="image" class="light:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30-dark.svg') }}"/>
            </div>
            <h3 class="text-lg font-medium text-mono text-center mb-3">
                {{ __('Check your email') }}
            </h3>
            <div class="text-sm text-center text-secondary-foreground mb-7.5">
                {{ __('Please click the link sent to your email') }}
                <a class="text-sm text-mono font-medium hover:text-primary" href="#">
                    {{ Auth::user()->email }}
                </a>
                <br/>
                {{ __('to verify your account. Thank you') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="text-sm text-center text-green-600 mb-4">
                    {{ __('A new verification link has been sent to your email.') }}
                </div>
            @endif

            <div class="flex flex-col gap-2">
                <button wire:click="resend" class="kt-btn kt-btn-primary flex justify-center">
                    {{ __('Resend Verification Email') }}
                </button>
                <button wire:click="logout" class="kt-btn kt-btn-ghost flex justify-center">
                    {{ __('Log out') }}
                </button>
            </div>
        </div>
    @endif
</div>
