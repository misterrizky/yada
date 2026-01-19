<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('components.layouts.app.metronic.partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:54px] [--sidebar-width:200px]">
        <livewire:shared.theme-toggle />

        <!-- Page -->
        <!-- Main -->
        <div class="flex grow flex-col in-data-kt-[sticky-header=on]:pt-(--header-height)">
            <livewire:metronic.5.header />

            <livewire:metronic.5.navbar />

            <!-- Wrapper Container -->
            <div class="container-fixed w-full flex px-0 lg:ps-4">
                <livewire:metronic.5.sidebar />

                <!-- Content -->
                <main class="flex flex-col grow" id="content" role="content">
                    <livewire:metronic.5.toolbar />

					{{ $slot }}

                    <livewire:metronic.5.footer />
                </main>
                <!-- End of Content -->
            </div>
            <!-- End of Wrapper Container -->
        </div>
        <!-- End of Main -->

        @include('components.layouts.app.metronic.partials.scripts')
        @livewireScripts
    </body>
</html>
