<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background">
        <style>
            .page-bg {
                background-image: url('assets/media/images/2600x1200/bg-10.png');
            }
            .dark .page-bg {
                background-image: url('assets/media/images/2600x1200/bg-10-dark.png');
            }
        </style>
        <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
            <div class="kt-card max-w-[370px] w-full">
                {{ $slot }}
            </div>
        </div>
        <script data-navigate-once src="{{ asset('assets/js/core.bundle.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendors/ktui/ktui.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        @fluxScripts
    </body>
</html>
