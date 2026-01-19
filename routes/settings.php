<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('profile', 'apps.profile.edit')->name('profile.edit');
    Volt::route('profile/password', 'apps.profile.password')->name('profile.edit-password');
    Volt::route('profile/appearance', 'apps.profile.appearance')->name('profile.appearance');

    Volt::route('profile/two-factor', 'apps.profile.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('profile.two-factor.show');
});
