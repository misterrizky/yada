<flux:navbar
    class="fixed inset-x-0 bottom-0 z-50 lg:hidden"
    data-test="mobile-bottom-nav"
    role="navigation"
    aria-label="Mobile bottom navigation"
>
    <!-- Container -->
    <div
        class="mx-auto flex w-full max-w-screen-sm items-center justify-around gap-1
               border-t border-zinc-200/70 bg-zinc-50/80 px-2
               pb-[calc(env(safe-area-inset-bottom)+0.25rem)] pt-0
               shadow-[0_-6px_20px_-18px_rgba(0,0,0,0.35)]
               backdrop-blur supports-[backdrop-filter]:bg-zinc-50/70
               dark:border-zinc-800/70 dark:bg-zinc-950/70"
    >
        <flux:navbar.item
            class="group relative flex min-h-[52px] flex-1 flex-col items-center justify-center gap-1
                   rounded-xl px-2 py-2 text-[11px] leading-none
                   text-zinc-500 transition
                   hover:bg-zinc-100/80 hover:text-zinc-900
                   active:scale-[0.98]
                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-400/60
                   dark:text-zinc-400 dark:hover:bg-zinc-900/60 dark:hover:text-zinc-100
                   [&>div>svg]:size-5 [&>div>svg]:transition-transform group-hover:[&>div>svg]:-translate-y-[1px]
                   aria-[current=page]:text-zinc-900 aria-[current=page]:bg-zinc-100/90
                   dark:aria-[current=page]:text-zinc-50 dark:aria-[current=page]:bg-zinc-900/70
                   aria-[current=page]:shadow-sm
                   aria-[current=page]:after:absolute aria-[current=page]:after:-top-1 aria-[current=page]:after:h-1 aria-[current=page]:after:w-8 aria-[current=page]:after:rounded-full
                   aria-[current=page]:after:bg-zinc-900 dark:aria-[current=page]:after:bg-zinc-100"
            icon="layout-grid"
            :href="route('app.dashboard')"
            :current="request()->routeIs('dashboard')"
            wire:navigate
        >
            {{ __('Dashboard') }}
        </flux:navbar.item>

        <flux:navbar.item
            class="group relative flex min-h-[52px] flex-1 flex-col items-center justify-center gap-1
                   rounded-xl px-2 py-2 text-[11px] leading-none
                   text-zinc-500 transition
                   hover:bg-zinc-100/80 hover:text-zinc-900
                   active:scale-[0.98]
                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-400/60
                   dark:text-zinc-400 dark:hover:bg-zinc-900/60 dark:hover:text-zinc-100
                   [&>div>svg]:size-5 [&>div>svg]:transition-transform group-hover:[&>div>svg]:-translate-y-[1px]"
            icon="magnifying-glass"
            href="#"
            aria-label="Search"
        >
            {{ __('Search') }}
        </flux:navbar.item>

        <flux:navbar.item
            class="group relative flex min-h-[52px] flex-1 flex-col items-center justify-center gap-1
                   rounded-xl px-2 py-2 text-[11px] leading-none
                   text-zinc-500 transition
                   hover:bg-zinc-100/80 hover:text-zinc-900
                   active:scale-[0.98]
                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-400/60
                   dark:text-zinc-400 dark:hover:bg-zinc-900/60 dark:hover:text-zinc-100
                   [&>div>svg]:size-5 [&>div>svg]:transition-transform group-hover:[&>div>svg]:-translate-y-[1px]
                   aria-[current=page]:text-zinc-900 aria-[current=page]:bg-zinc-100/90
                   dark:aria-[current=page]:text-zinc-50 dark:aria-[current=page]:bg-zinc-900/70
                   aria-[current=page]:shadow-sm
                   aria-[current=page]:after:absolute aria-[current=page]:after:-top-1 aria-[current=page]:after:h-1 aria-[current=page]:after:w-8 aria-[current=page]:after:rounded-full
                   aria-[current=page]:after:bg-zinc-900 dark:aria-[current=page]:after:bg-zinc-100"
            icon="cog-6-tooth"
            :href="route('profile.edit')"
            :current="request()->routeIs('profile.edit')"
            wire:navigate
        >
            {{ __('Settings') }}
        </flux:navbar.item>

        <flux:navbar.item
            class="group relative flex min-h-[52px] flex-1 flex-col items-center justify-center gap-1
                   rounded-xl px-2 py-2 text-[11px] leading-none
                   text-zinc-500 transition
                   hover:bg-zinc-100/80 hover:text-zinc-900
                   active:scale-[0.98]
                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-400/60
                   dark:text-zinc-400 dark:hover:bg-zinc-900/60 dark:hover:text-zinc-100
                   [&>div>svg]:size-5 [&>div>svg]:transition-transform group-hover:[&>div>svg]:-translate-y-[1px]"
            icon="book-open-text"
            href="https://laravel.com/docs/starter-kits#livewire"
            target="_blank"
            rel="noopener noreferrer"
        >
            {{ __('Docs') }}
        </flux:navbar.item>
    </div>
</flux:navbar>