<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 max-lg:pb-16">
        <x-layouts.app.flux.partials.sidebar/>
        <x-layouts.app.flux.partials.sidebar.header/>
        <!-- Mobile User Menu -->
        <x-layouts.app.flux.partials.mobile/>
        <flux:main>
            {{ $slot }}
        </flux:main>
        @fluxScripts
    </body>
</html>