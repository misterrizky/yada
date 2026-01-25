<?php
use function Laravel\Folio\name;
use Livewire\Volt\Component;

name('app.country.create');

new class extends Component {

}
?>
<x-layouts.app :title="__('Regional : Country')">
    @volt
    <flux:main>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Master</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Regional</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('app.country')" wire:navigate>Country</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Create</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <flux:heading class="mt-5" size="xl" level="1">Add Country</flux:heading>
            </div>
            <div class="flex items-center gap-2.5">
                <flux:button variant="filled" :href="route('app.country')" wire:navigate>Back</flux:button>
            </div>
        </div>
        <flux:separator variant="subtle" />
    </flux:main>
    @endvolt
</x-layouts.app>