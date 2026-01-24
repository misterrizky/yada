<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div
        class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div
            class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
            <div class="absolute inset-0 bg-neutral-900"></div>
            <a href="{{ route('web.home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <img src="{{ asset('icon.png') }}" class="me-2 h-7">
                </span>
                {{ config('app.name', 'Laravel') }}
            </a>

            {{-- <nav class="mt-auto" aria-label="Progress">
                <ol role="list" class="overflow-hidden">
                    <li class="relative pb-10">
                        <div aria-hidden="true" class="absolute top-4 left-4 mt-0.5 -ml-px h-full w-0.5 bg-indigo-500">
                        </div>
                        <!-- Complete Step -->
                        <a href="#" class="group relative flex items-start">
                            <span class="flex h-9 items-center">
                                <span
                                    class="relative z-10 flex size-8 items-center justify-center rounded-full bg-indigo-500 group-hover:bg-indigo-600">
                                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true"
                                        class="size-5 text-white">
                                        <path
                                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                            clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                            <span class="ml-4 flex min-w-0 flex-col">
                                <span class="text-sm font-medium text-white">Create account</span>
                                <span class="text-sm text-gray-400">Vitae sed mi luctus laoreet.</span>
                            </span>
                        </a>
                    </li>
                    <li class="relative pb-10">
                        <div aria-hidden="true" class="absolute top-4 left-4 mt-0.5 -ml-px h-full w-0.5 bg-gray-700">
                        </div>
                        <!-- Current Step -->
                        <a href="#" aria-current="step" class="group relative flex items-start">
                            <span aria-hidden="true" class="flex h-9 items-center">
                                <span
                                    class="relative z-10 flex size-8 items-center justify-center rounded-full border-2 border-indigo-500 bg-gray-900">
                                    <span class="size-2.5 rounded-full bg-indigo-500"></span>
                                </span>
                            </span>
                            <span class="ml-4 flex min-w-0 flex-col">
                                <span class="text-sm font-medium text-indigo-400">Profile information</span>
                                <span class="text-sm text-gray-400">Cursus semper viverra facilisis et et some
                                    more.</span>
                            </span>
                        </a>
                    </li>
                    <li class="relative pb-10">
                        <div aria-hidden="true" class="absolute top-4 left-4 mt-0.5 -ml-px h-full w-0.5 bg-white/15">
                        </div>
                        <!-- Upcoming Step -->
                        <a href="#" class="group relative flex items-start">
                            <span aria-hidden="true" class="flex h-9 items-center">
                                <span
                                    class="relative z-10 flex size-8 items-center justify-center rounded-full border-2 border-white/15 bg-gray-900 group-hover:border-white/25">
                                    <span class="size-2.5 rounded-full bg-transparent group-hover:bg-white/15"></span>
                                </span>
                            </span>
                            <span class="ml-4 flex min-w-0 flex-col">
                                <span class="text-sm font-medium text-gray-400">Business information</span>
                                <span class="text-sm text-gray-400">Penatibus eu quis ante.</span>
                            </span>
                        </a>
                    </li>
                    <li class="relative pb-10">
                        <div aria-hidden="true" class="absolute top-4 left-4 mt-0.5 -ml-px h-full w-0.5 bg-white/15">
                        </div>
                        <!-- Upcoming Step -->
                        <a href="#" class="group relative flex items-start">
                            <span aria-hidden="true" class="flex h-9 items-center">
                                <span
                                    class="relative z-10 flex size-8 items-center justify-center rounded-full border-2 border-white/15 bg-gray-900 group-hover:border-white/25">
                                    <span class="size-2.5 rounded-full bg-transparent group-hover:bg-white/15"></span>
                                </span>
                            </span>
                            <span class="ml-4 flex min-w-0 flex-col">
                                <span class="text-sm font-medium text-gray-400">Theme</span>
                                <span class="text-sm text-gray-400">Faucibus nec enim leo et.</span>
                            </span>
                        </a>
                    </li>
                    <li class="relative">
                        <!-- Upcoming Step -->
                        <a href="#" class="group relative flex items-start">
                            <span aria-hidden="true" class="flex h-9 items-center">
                                <span
                                    class="relative z-10 flex size-8 items-center justify-center rounded-full border-2 border-white/15 bg-gray-900 group-hover:border-white/25">
                                    <span class="size-2.5 rounded-full bg-transparent group-hover:bg-white/15"></span>
                                </span>
                            </span>
                            <span class="ml-4 flex min-w-0 flex-col">
                                <span class="text-sm font-medium text-gray-400">Preview</span>
                                <span class="text-sm text-gray-400">Iusto et officia maiores porro ad non quas.</span>
                            </span>
                        </a>
                    </li>
                </ol>
            </nav> --}}

            @php
                [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp

            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2">
                    <flux:heading size="lg">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                    <footer>
                        <flux:heading>{{ trim($author) }}</flux:heading>
                    </footer>
                </blockquote>
            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <a href="{{ route('web.home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
