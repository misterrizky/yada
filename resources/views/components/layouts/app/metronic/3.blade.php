<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('components.layouts.app.metronic.partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:58px] [--sidebar-width:58px] [--navbar-height:56px] lg:overflow-hidden bg-muted">
        <livewire:shared.theme-toggle />

        <!-- Page -->
        <!-- Base -->
        <div class="flex grow">
            <livewire:metronic.3.header />

            <!-- Wrapper -->
            <div class="flex flex-col lg:flex-row grow pt-(--header-height)">
                <livewire:metronic.3.sidebar />

                <!-- Main -->
                <livewire:metronic.3.navbar />

                <div class="flex grow rounded-b-xl bg-background border-x border-b border-input lg:mt-(--navbar-height) mx-5 lg:ms-(--sidebar-width) mb-5">
                    <div class="flex flex-col grow kt-scrollable-y lg:[scrollbar-width:auto] pt-7 lg:[&_.kt-container-fluid]:pe-4" id="scrollable_content">
                        <!-- Content -->
                        <main class="grow" role="content">
                            {{ $slot }}
                        </main>
                        <!-- End of Content -->
                        <livewire:metronic.3.footer />
                    </div>
                </div>
                <!-- End of Main -->
            </div>
            <!-- End of Wrapper -->
        </div>
        <!-- End of Base -->
        <!-- End of Page -->

        @include('components.layouts.app.metronic.partials.scripts')
        @livewireScripts
    </body>
</html>
