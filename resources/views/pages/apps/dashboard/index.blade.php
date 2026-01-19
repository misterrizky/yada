<?php
use function Laravel\Folio\name;
use function Livewire\Volt\state;

state([
    'layout' => fn () => app(\App\Settings\AppearanceSettings::class)->layout_app,
    'theme' => fn () => app(\App\Settings\AppearanceSettings::class)->theme_app,
]);

name('app.dashboard');
?>
<x-layouts.app :title="__('Dashboard')">
    @volt
        <div>
            @if ($this->theme == "flux")
                <flux:heading size="xl" level="1">Hello, {{ auth()->user()->name }}</flux:heading>
                <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>
                <flux:separator variant="subtle" />
            @else
                <div>
                    asd
                </div>
            @endif
        </div>
    @endvolt
</x-layouts.app>
