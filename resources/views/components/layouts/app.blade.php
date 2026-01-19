@php
    $app = app(\App\Settings\AppearanceSettings::class);
    $theme = $app->theme_app;
    $layout = $app->layout_app;
@endphp
<x-dynamic-component :component="'layouts.app.' .$theme . '.' . $layout" :title="$title ?? null">
    @if ($theme == "flux")
        {{ $slot }}
    @else
        {{ $slot }}
    @endif
</x-dynamic-component>