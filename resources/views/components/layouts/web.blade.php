@props([
    'title' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? config('app.name') }}</title>
        <link rel="canonical" href="{{ url()->current() }}"/>
        @vite(['resources/css/app.css'])
        <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}"/>
    </head>
    <body class="min-h-screen bg-white dark:bg-black antialiased selection:bg-white/20 selection:text-white dark:text-white flex flex-col">
        <x-layouts.web.header context="web" />
        <main class="flex-1 bg-white dark:bg-black">
            {{ $slot }}
        </main>
        <x-layouts.web.footer context="web" />
        @vite(['resources/js/app.js'])
        <script src="{{ asset('assets/js/three.min.js') }}"></script>
        <script src="{{ asset('assets/js/panolens.min.js') }}"></script>
        <!-- GSAP + ScrollTrigger -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollTrigger.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollSmoother.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/SplitText.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Flip.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Draggable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/DrawSVGPlugin.min.js"></script>
        <script src="https://code.createjs.com/1.0.0/easeljs.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/EaselPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/GSDevTools.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/InertiaPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MorphSVGPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MotionPathPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/MotionPathHelper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Observer.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/Physics2DPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/PhysicsPropsPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pixi.js@7.4.0/dist/pixi.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/PixiPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrambleTextPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/ScrollToPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.1/dist/TextPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-element-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>
        <script data-navigate-once src="{{ asset('assets/js/web.js') }}"></script>
        
   


    </body>
</html>
