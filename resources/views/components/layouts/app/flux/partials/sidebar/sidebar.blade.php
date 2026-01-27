<flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand
            href="{{ route('app.dashboard') }}"
            logo="{{ asset('icon.png') }}"
            logo:dark="{{ asset('icon-dark.png') }}"
            name="Yada Ekidanta"
        />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group :heading="__('Platform')" class="grid">
            <flux:sidebar.item icon="home" :href="route('app.dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
        @role('Client|Partner')
        <x-layouts.app.flux.partials.sidebar.client/>
        @else
        <x-layouts.app.flux.partials.sidebar.internal/>
        @endrole
    </flux:sidebar.nav>
    <flux:spacer />
    @role('Client|Partner')
    @else
    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
        <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
        <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
            {{ __('Repository') }}
        </flux:sidebar.item>

        <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
            {{ __('Documentation') }}
        </flux:sidebar.item>
    </flux:sidebar.nav>
    @endrole
</flux:sidebar>