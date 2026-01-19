<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'email' => '',
    'password' => '',
    'remember' => false,
    'layout' => fn () => app(\App\Settings\AppearanceSettings::class)->layout_auth,
    'allow_registration' => fn () => app(\App\Settings\AuthSettings::class)->client_allow_registration,
]);

rules([
    'email' => 'required|email',
    'password' => 'required',
]);

$signin = function () {
    $this->validate();

    if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    session()->regenerate();

    return redirect()->intended(config('fortify.home', '/dashboard'));
};
?>

<div class="w-full">
    @if ($layout == 'card' || $layout == 'simple' || $layout == 'split')
        <div class="flex flex-col gap-6">
            <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')"/>
            <x-auth-session-status class="text-center" :status="session('status')"/>
            <form wire:submit="signin" class="flex flex-col gap-6">
                <flux:input wire:model="email" :label="__('Email address')" type="email" required autofocus autocomplete="email" placeholder="email@example.com"/>
                <div class="relative">
                    <flux:input wire:model="password" :label="__('Password')" type="password" required autocomplete="current-password" :placeholder="__('Password')" viewable/>
                    @if (Route::has('password.request'))
                        <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>{{ __('Forgot your password?') }}</flux:link>
                    @endif
                </div>
                <flux:checkbox wire:model="remember" :label="__('Remember me')"/>
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">{{ __('Log in') }}</flux:button>
                </div>
            </form>
            @if ($allow_registration)
                <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Don\'t have an account?') }}</span>
                    <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                </div>
            @endif
        </div>
    @else
        <form wire:submit="signin" class="kt-card-content flex flex-col gap-5 p-10">
            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Sign in</h3>
                @if ($allow_registration)
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">Need an account?</span>
                    <a class="text-sm link" href="{{ route('register') }}" wire:navigate>Sign up</a>
                </div>
                @endif
            </div>
            @if ($allow_registration)
            <div class="grid grid-cols-2 gap-2.5">
                <a class="kt-btn kt-btn-outline justify-center" href="#"><img alt="" class="size-3.5 shrink-0" src="assets/media/brand-logos/google.svg"/>Use Google</a>
                <a class="kt-btn kt-btn-outline justify-center" href="#"><img alt="" class="size-3.5 shrink-0 dark:hidden" src="assets/media/brand-logos/apple-black.svg"/><img alt="" class="size-3.5 shrink-0 light:hidden" src="assets/media/brand-logos/apple-white.svg"/>Use Apple</a>
            </div>
            <div class="flex items-center gap-2">
                <span class="border-t border-border w-full"></span>
                <span class="text-xs text-muted-foreground font-medium uppercase">Or</span>
                <span class="border-t border-border w-full"></span>
            </div>
            @endif
            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Email</label>
                <input wire:model="email" class="kt-input" placeholder="email@email.com" type="email"/>
                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between gap-1">
                    <label class="kt-form-label font-normal text-mono">Password</label>
                    <a class="text-sm kt-link shrink-0" href="{{ route('password.request') }}" wire:navigate>Forgot Password?</a>
                </div>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input wire:model="password" placeholder="Enter Password" type="password"/>
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true" type="button">
                        <span class="kt-toggle-password-active:hidden"><i class="ki-filled ki-eye text-muted-foreground"></i></span>
                        <span class="hidden kt-toggle-password-active:block"><i class="ki-filled ki-eye-slash text-muted-foreground"></i></span>
                    </button>
                </div>
                @error('password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            <label class="kt-label">
                <input wire:model="remember" class="kt-checkbox kt-checkbox-sm" type="checkbox"/>
                <span class="kt-checkbox-label">Remember me</span>
            </label>
            <button class="kt-btn kt-btn-primary flex justify-center grow">Sign In</button>
        </form>
    @endif
</div>
