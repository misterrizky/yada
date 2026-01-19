<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">

<head>
    @include('components.layouts.app.metronic.partials.head')
	@livewireStyles
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:78px]">
	<livewire:shared.theme-toggle />

	<!-- Page -->
	<!-- Main -->
	<div class="flex grow flex-col in-data-kt-[sticky-header=on]:pt-(--header-height)">
		<livewire:metronic.9.header />

		<livewire:metronic.9.navbar />

		<!-- Wrapper Container -->
		<div class="container-fixed w-full flex px-0">
			<!-- Content -->
			<main class="flex flex-col grow" id="content" role="content">
				<!-- Toolbar -->
				<livewire:metronic.9.toolbar />
				<!-- End of Toolbar -->
				<!-- Container -->
				<div class="kt-container-fixed">
					{{ $slot }}
				</div>
				<!-- End of Container -->
				<!-- Footer -->
				<livewire:metronic.9.footer />
				<!-- End of Footer -->
			</main>
			<!-- End of Content -->


		</div>
		<!-- End of Page -->

    @include('components.layouts.app.metronic.partials.scripts')
		@livewireScripts
</body>

</html>
