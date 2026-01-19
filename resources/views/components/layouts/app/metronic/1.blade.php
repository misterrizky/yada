<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('components.layouts.app.metronic.partials.head')
    </head>
    <body class="demo1 kt-sidebar-fixed kt-header-fixed flex h-full bg-background text-base text-foreground antialiased">
        <livewire:shared.theme-toggle />

        <!-- Page -->
        <!-- Main -->
        <div class="flex grow">
            <livewire:metronic.1.sidebar />

            <!-- Wrapper -->
            <div class="kt-wrapper flex grow flex-col">
                @persist('mega-menu')
                    <livewire:metronic.1.header />
                @endpersist

                <!-- Content -->
                <main class="grow pt-5" id="content" role="content">
                    {{ $slot }}
                </main>
                <!-- End of Content -->

                <livewire:metronic.1.footer />
            </div>
            <!-- End of Wrapper -->
        </div>
        <!-- End of Main -->
        <!-- End of Page -->

        @include('components.layouts.app.metronic.partials.scripts')
        <livewire:shared.modals.search />
    </body>
</html>
