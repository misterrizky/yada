<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('components.layouts.app.metronic.partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:60px] [--sidebar-width:90px] bg-muted">
		<livewire:shared.theme-toggle />

        <!-- Page -->
        <!-- Base -->
        <div class="flex grow">
            <!-- Wrapper -->
            <div class="flex flex-col lg:flex-row grow pt-(--header-height) lg:pt-0">
                <livewire:metronic.8.sidebar />
                <!-- Main -->
                <div class="flex flex-col grow rounded-xl bg-background border border-input lg:ms-(--sidebar-width) mt-0 lg:mt-5 m-5">
                    <div class="flex flex-col grow kt-scrollable-y-auto lg:[--scrollbar-width:auto] pt-5" id="scrollable_content">
                        <main class="grow" role="content">
                            <livewire:metronic.8.toolbar />
                            <!-- Container -->
                            <div class="kt-container-fixed">
                                {{ $slot }}
                            </div>
                            <!-- End of Container -->
                        </main>
                        <!-- End of Content -->
                    </div>

					<livewire:metronic.8.footer />
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
