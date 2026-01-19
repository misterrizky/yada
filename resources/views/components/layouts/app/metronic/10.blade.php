<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">

<head>
    @include('components.layouts.app.metronic.partials.head')
	@livewireStyles
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:60px] [--sidebar-width:270px] lg:overflow-hidden bg-mono dark:bg-background">
	<livewire:shared.theme-toggle />

	<!-- Page -->
	<div class="flex grow">
		<!-- Header -->
		<livewire:metronic.10.header />
		<!-- End of Header -->
		<!-- Wrapper -->
		<div class="flex flex-col lg:flex-row grow pt-(--header-height) lg:pt-0">
			<!-- Sidebar -->
			<livewire:metronic.10.sidebar />
			<!-- End of Sidebar -->
			<!-- Main -->
			<div class="flex flex-col grow lg:rounded-l-xl bg-background border border-input lg:ms-(--sidebar-width)">
				<div class="flex flex-col grow kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto] pt-5" id="scrollable_content">
					<main class="grow" role="content">
						<!-- Toolbar -->
						<livewire:metronic.10.toolbar />
						<!-- End of Toolbar -->
						<!-- Container -->
						<div class="kt-container-fixed">
							{{ $slot }}
						</div>
						<!-- End of Container -->
					</main>
					<!-- Footer -->
					<livewire:metronic.10.footer />
					<!-- End of Footer -->
				</div>
			</div>
			<!-- End of Main -->
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page -->

    @include('components.layouts.app.metronic.partials.scripts')
	@livewireScripts
</body>

</html>
