<?php
use function Livewire\Volt\{state};

state([
    'unreadCounts' => fn() => Auth::check() ? Auth::user()->unreadNotifications->count() : 0,
    'notifications' => fn() => Auth::check() ? Auth::user()->notifications()->latest()->take(10)->get() : collect(),
]);
$headerloadNotification = function() {
    if (Auth::check()) {
        $this->unreadCounts = Auth::user()->unreadNotifications->count();
        $this->notifications = Auth::user()->notifications()->latest()->take(10)->get();
    }
};
// Fungsi untuk menandai notifikasi sebagai dibaca
$markAsRead = function($notificationId) {
    if (Auth::check()) {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->headerloadNotification();
        }
    }
};

// Fungsi untuk menandai semua notifikasi sebagai dibaca
$markAllAsReads = function() {
    if (Auth::check()) {
        Auth::user()->unreadNotifications->markAsRead();
        $this->headerloadNotification();
    }
};

// Fungsi untuk menghapus notifikasi
$deleteNotifications = function($notificationId) {
    if (Auth::check()) {
        Auth::user()->notifications()->where('id', $notificationId)->delete();
        $this->headerloadNotification();
    }
};
$hapus = function(){
    Auth::user()->st = 'deactive';
    Auth::user()->save();
    auth()->logout();
    $route = route('login');
    return $this->redirect($route, navigate: true);
};
$logout = function(){
    auth()->logout();
    $route = route('login');
    return $this->redirect($route, navigate: true);
};
?>
<flux:header
    x-data="{
        openCmd: false,

        openCommand() {
            this.openCmd = true
            this.$nextTick(() => this.$refs.cmdInput?.focus())
        },

        closeCommand() {
            this.openCmd = false
        },

        toggleTheme() {
            $flux.appearance = ($flux.appearance === 'dark') ? 'light' : 'dark'
        }
    }"
    @keydown.window.prevent.ctrl.k="openCommand()"
    @keydown.window.prevent.meta.k="openCommand()"
    @keydown.window.prevent.ctrl.d="toggleTheme()"
    class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700"
>
    <flux:navbar class="mx-5 w-full">
        <div class="flex w-full items-center gap-3">
            <div class="flex-1">
                <div @click="openCommand()">
                    <flux:input class="w-full" kbd="⌘K" icon="magnifying-glass" placeholder="Search..."/>
                </div>
                <div x-cloak x-show="openCmd" @keydown.window.escape="closeCommand()" @click.self="closeCommand()" class="fixed inset-0 z-50 flex items-start justify-center bg-black/40 pt-24">
                    <div class="w-full max-w-xl">
                        <flux:command>
                            <flux:command.input x-ref="cmdInput" placeholder="Search..." />
                            <flux:command.items>
                                <flux:command.item wire:click="..." icon="user-plus" kbd="⌘A">Assign to…</flux:command.item>
                                <flux:command.item wire:click="..." icon="document-plus">Create new file</flux:command.item>
                                <flux:command.item wire:click="..." icon="folder-plus" kbd="⌘⇧N">Create new project</flux:command.item>
                                <flux:command.item wire:click="..." icon="book-open">Documentation</flux:command.item>
                                <flux:command.item wire:click="..." icon="newspaper">Changelog</flux:command.item>
                                <flux:command.item wire:click="..." icon="cog-6-tooth" kbd="⌘,">Settings</flux:command.item>
                            </flux:command.items>
                        </flux:command>
                    </div>
                </div>
            </div>
            <div x-data class="ml-auto flex items-center">
                <flux:navbar.item class="hidden dark:block" @click="$flux.appearance = 'light'" x-cloak>
                    <flux:icon.sun variant="outline" class="text-amber-500 dark:text-amber-300" />
                </flux:navbar.item>
                <flux:navbar.item class="block dark:hidden" @click="$flux.appearance = 'dark'" x-cloak>
                    <flux:icon.moon variant="outline"/>
                </flux:navbar.item>
            </div>
        </div>
    </flux:navbar>
    <flux:spacer />
    <flux:separator vertical />
    <flux:navbar class="mx-5">
        <flux:dropdown class="bottom center">
            <flux:button variant="ghost" icon="bell" aria-label="Notifications" />
            <flux:popover class="w-[22rem] sm:w-96 p-0 overflow-hidden data-open:flex flex-col bg-white dark:bg-zinc-950 ring-1 ring-zinc-200 dark:ring-zinc-800">
                <div class="flex items-center justify-between gap-2 px-4 py-3">
                    <div class="flex items-center gap-2">
                        <flux:heading>Notifications</flux:heading>
                        <span class="inline-flex items-center rounded-full bg-zinc-100 px-2 py-0.5 text-xs text-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">
                            3
                        </span>
                    </div>
                    <div class="flex items-center gap-1">
                        <flux:button variant="ghost" icon="check" class="!-p-2" aria-label="Mark all as read" />
                        <flux:button variant="ghost" icon="cog-6-tooth" class="!-p-2" aria-label="Notification settings" />
                    </div>
                </div>
                <flux:separator />
                <div class="px-4 py-3">
                    <flux:radio.group variant="segmented" class="w-full">
                        <flux:radio value="all" label="All" checked />
                        <flux:radio value="unread" label="Unread" />
                    </flux:radio.group>
                </div>
                <flux:separator />
                <div class="max-h-[22rem] overflow-auto">
                    <a href="#" class="group flex gap-3 px-4 py-3 hover:bg-zinc-900 dark:hover:bg-zinc-900">
                        <div class="mt-0.5">
                            <flux:avatar size="xs" circle src="https://unavatar.io/github/joshhanley" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <flux:heading class="text-sm truncate">New message</flux:heading>
                                        <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                                    </div>
                                    <flux:text class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                        Josh mentioned you in “Invoice Q1”. Please review the update.
                                    </flux:text>
                                </div>

                                <flux:text class="shrink-0 text-xs text-zinc-500 dark:text-zinc-400">
                                    2m
                                </flux:text>
                            </div>
                            <div class="mt-2 flex items-center gap-2">
                                <flux:button variant="ghost" class="!-p-0 text-xs">Open</flux:button>
                                <span class="text-zinc-300 dark:text-zinc-700">·</span>
                                <flux:button variant="ghost" class="!-p-0 text-xs">Mute</flux:button>
                            </div>
                        </div>
                    </a>
                    <flux:separator />
                    <a href="#" class="group flex gap-3 px-4 py-3 hover:bg-zinc-900 dark:hover:bg-zinc-900">
                        <div class="mt-0.5">
                            <div class="grid h-7 w-7 place-items-center rounded-full bg-zinc-100 dark:bg-zinc-900">
                                <flux:icon.folder-plus variant="micro" class="text-zinc-500 dark:text-zinc-400" />
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <flux:heading class="text-sm truncate">Project created</flux:heading>
                                    <flux:text class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                        “Website Revamp” has been created successfully.
                                    </flux:text>
                                </div>
                                <flux:text class="shrink-0 text-xs text-zinc-500 dark:text-zinc-400">
                                    1h
                                </flux:text>
                            </div>
                        </div>
                    </a>
                    <flux:separator />
                    <a href="#" class=" group flex gap-3 px-4 py-3 hover:bg-zinc-900 dark:hover:bg-zinc-900">
                        <div class="mt-0.5">
                            <div class="grid h-7 w-7 place-items-center rounded-full bg-zinc-100 dark:bg-zinc-900">
                                <flux:icon.shield-check variant="micro" class="text-zinc-500 dark:text-zinc-400" />
                            </div>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <flux:heading class="text-sm truncate">Security</flux:heading>
                                    <flux:text class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-2">
                                        New login detected from Jakarta, ID.
                                    </flux:text>
                                </div>
                                <flux:text class="shrink-0 text-xs text-zinc-500 dark:text-zinc-400">
                                    Yesterday
                                </flux:text>
                            </div>
                        </div>
                    </a>
                </div>
                <flux:separator />
                <div class="px-4 py-3">
                    <flux:button class="w-full" variant="ghost">
                        View all notifications
                    </flux:button>
                </div>
            </flux:popover>
        </flux:dropdown>
        <flux:dropdown>
            <flux:button variant="ghost" icon="plus"></flux:button>
            <flux:menu>
                <flux:menu.group heading="Quick Create" icon:trailing="plus">
                    <flux:menu.item icon="building-office" kbd="⌘COM">Company</flux:menu.item>
                    <flux:menu.item icon="identification" kbd="⌘CON">Contact</flux:menu.item>
                    <flux:menu.item icon="banknotes" kbd="⌘DEA">Deals</flux:menu.item>
                </flux:menu.group>
            </flux:menu>
        </flux:dropdown>
        @role('Client|Partner')
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
        @endrole
        @role('Super Admin')
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
        @endrole
    </flux:navbar>
    <flux:separator vertical />

    @stack('app-header-actions')

    <flux:dropdown class="mx-5" position="top" align="end">
        <flux:profile
            :initials="auth()->user()->initials()"
            icon-trailing="chevron-down"
        />
        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <flux:avatar
                            :name="auth()->user()->name"
                            :initials="auth()->user()->initials()"
                        />
                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                            <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <flux:menu.radio.group>
                <flux:menu.item :href="route('profile.edit')" icon="user" wire:navigate>
                    {{ __('Profile') }}
                </flux:menu.item>
            </flux:menu.radio.group>
            <flux:menu.separator />
            @volt
            <flux:menu.item
                as="button"
                wire:click="logout"
                icon="arrow-right-start-on-rectangle"
                class="w-full cursor-pointer"
            >
                {{ __('Log Out') }}
            </flux:menu.item>
            @endvolt
        </flux:menu>
    </flux:dropdown>
</flux:header>
